<?php
namespace View;
use HTML\HTML as HTML;
use DB\DB as DB;

class View {
	
	private $_controller;
	private $_action;
	
	/*
	public function __construct($controller,$action) {
		$this->_controller = $controller;
		$this->_action = $action;
	}
	*/

	/** Display View */
    public static function render($controller, $action, $doNotRenderHeader = 0) {
		
		$html = new HTML;
		$url = self::explodeLink();
		if(!isset($url[0]))
			$url[0] = "";

		$db = new DB();
		$db->bind('name', 'isActive');
		$active = $db->query("SELECT * FROM mia_settings WHERE name = :name");

		if ($active[0]['value'] == '0' && $url[0] != 'admin')
		{
			require_once(fileDir.'/app/views/header.php');
			require_once(fileDir.'/app/views/errors/offline.php');
		}
		else
		{
			if ($doNotRenderHeader == 0) {
				
				if (file_exists(fileDir.'/app/views/'.$controller.'/header.php')) {
					include (fileDir.'/app/views/'.$controller.'/header.php');
				} else {
					include (fileDir.'/app/views/header.php');
				}
			}
			
			if (file_exists(fileDir.'/app/views/'.$controller.'/'.$action.'.php')) {
				include (fileDir.'/app/views/'.$controller.'/'.$action.'.php');		 
			}
				
			if ($doNotRenderHeader == 0) {
				if (file_exists(fileDir.'/app/views'.$controller.'/footer.php')) {
					include (fileDir.'/app/views'.$controller.'/footer.php');
				} else {
					include (fileDir.'/app/views/footer.php');
				}
			}
		}
    }

    /** Explodeing URL on parts */
    public static function explodeLink()
    {
    	if(isset($_GET['url']))
			$url = explode('/', $_GET['url']);
		else
			$url = "";
		return $url;
    }

    /** Methods for gettings key templates */
    public static function renderHeader()
    {
    	$db = new DB();
    	$db->bind('group_id', '0');
    	$data = $db->query('SELECT * FROM mia_settings WHERE group_id = :group_id');
    	foreach ($data as $value) {
    		switch ($value['name']) {
    			case 'projectName':	$projectName = $value['value'];	break;
    			case 'projectCharset': $projectCharset = $value['value']; break;
    			case 'projectRobots': $projectRobots = $value['value']; break;
    			case 'projectDescription': $projectDescription = $value['value']; break;
    			case 'cssLibraries': $cssLibraries = $value['value']; break;
       		}
    	}

    	$header = "
    	<!DOCTYPE html>
    	<html>
    	<head>
	    	<meta charset=".$projectCharset."\" />
    		<title>".$projectName."</title>
    		<meta name=\"robots\" content=\"".$projectRobots."\" />
    		<meta name=\"description\" content=\"".$projectDescription."\" />
    		";

    	foreach(preg_split("/((\r?\n)|(\r\n?))/", $cssLibraries) as $line)
    	{
    		$header = $header. "<link rel=\"stylesheet\" href=\"/libraries/css/".$line."\" />";
    	}
    	
    	return $header;
    }

    public static function renderFooter()
    {
    	$db = new DB();
    	$db->bind('name', 'jQueryLibrary');
    	$data = $db->query('SELECT * FROM mia_settings WHERE name = :name');

    	switch ($jQueryLibrary) {
    		case '1':
				$footer = '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>';
    			break;
    		case '2':
    			$footer = '<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.1.min.js"></script>';
    			break;
       		case '3':
    			$footer = '<script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>';
    			break;
    		default:
    			break;
    	}

    	$footer = $footer."
    	</body>
    	</html>
    	";

    	return $footer;
    }
}