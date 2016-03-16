<?php
use Cache\Cache as Cache;
use Inflection\Inflection as Inflection;

Class Bootstrap {
    protected static $_instance = null;

	private function __construct()
	{
		// the private constructor limits getInstance()'s realization
	}
	protected function __clone()
	{
		// limits object cloning
	}

    /**
     * @return App
     */
    public final function singleton() {
        if (!self::$_instance)
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
	
	/** Check if environment is development and display errors **/
	private final function developmentMode() {
		if (DEVELOPMENT_ENVIRONMENT == true)
			{
			error_reporting(E_ALL);
			ini_set('display_errors','On');
		}
		else
		{
			error_reporting(E_ALL);
			ini_set('display_errors','Off');
			ini_set('log_errors', 'On');
			ini_set('error_log', ROOT.'/app/logs/error.log');
		}
	}

	/** Check for Magic Quotes and remove them **/
	private final function stripSlashesDeep($value) {
		$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
		return $value;
	}

	private final function removeMagicQuotes() {
		if ( get_magic_quotes_gpc() ) {
			$_GET    = stripSlashesDeep($_GET   );
			$_POST   = stripSlashesDeep($_POST  );
			$_COOKIE = stripSlashesDeep($_COOKIE);
		}
	}
	
	/** Check register globals and remove them **/
	private final function unregisterGlobals() {
		if (ini_get('register_globals')) {
			$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
			foreach ($array as $value) {
				foreach ($GLOBALS[$value] as $key => $var) {
					if ($var === $GLOBALS[$key]) {
						unset($GLOBALS[$key]);
					}
				}
			}
		}
	}
	
	/** Routing **/
	private final function routeURL($url) {
		global $routing;

		foreach ( $routing as $pattern => $result ) {
				if ( preg_match( $pattern, $url ) ) {
					return preg_replace( $pattern, $result, $url );
				}
		}

		return ($url);
	}

    public final function launch() {
		self::developmentMode();
        require_once('View.php');

		if(isset($_GET['url']))
			$url = explode('/', $_GET['url']);
		
		self::loadModules();
		
		/** Connecting system moduls **/
		$cache = new Cache();
		$inflect = new Inflection();

		self::unregisterGlobals();
		self::removeMagicQuotes();
		
        if(!isset($url[0]) or empty($url[0]))
        {
            $controller = 'Main';
            $action = 'index';
        }
		else
		{
			$controller = $url[0];
			array_shift($url);
			if ((isset($url[0])) and (!empty($url[0])))
			{
				$action = $url[0];
				array_shift($url);
			}
		else
			$action = 'index'; // Default Action
		}
		
		if(isset($_GET['url']))
			$queryString = $url;
		else
			$queryString = array();
		
		$controllerName = ucfirst($controller).'Controller';

        require_once('Controller.php');
        require_once('Model.php');

		$controller = new Controller($controller, $action);

        if($controllerName == 'AdminController')
       		require_once('/system/admin/'.$controllerName.'.php');
        else
       		require_once('/app/controllers/'.$controllerName.'.php');
		$dispatch = new $controllerName($controller,$action);
		if ((int)method_exists($controllerName, $action)) {
			call_user_func_array(array($dispatch,"beforeAction"),$queryString);
			call_user_func_array(array($dispatch,$action),$queryString);
			call_user_func_array(array($dispatch,"afterAction"),$queryString);
		} else {
			/* Error Generation Code Here */
		}
    }

	private final function loadModules()
	{
		require_once(fileDir.'/system/Config.php');
		require_once(fileDir.'/system/Routes.php');
		require_once(fileDir.'/system/Cache/Handler.php');
		require_once(fileDir.'/system/DB/Handler.php');
		require_once(fileDir.'/system/Inflection/Handler.php');
		require_once(fileDir.'/system/HTML/Handler.php');
		$directory = fileDir.'/modules/';
		$scanned_directory = array_diff(scandir($directory), array('..', '.'));
		foreach($scanned_directory as $key => $value)
			require_once(fileDir.'/modules/'.$value.'/Handler.php');
	}
}