<?php
use View\View as View;

Class AdminController extends Controller {
	
	public function __construct() {
	}

    public function beforeAction()
	{

    }

    public function index()
	{
        require_once('/system/admin/templates/index.php');
    }

    public function dashboard()
    {
        $url = View::explodeLink();
        if(!isset($url[2])) $url[2] = "";
        if(!isset($url[3])) $url[3] = "";
        switch ($url[2]) {
            case 'modules':
                View::render('Admin', 'modules');
                break;
            case 'settings':
                switch ($url[3]) {
                    case 'isActive':
                        View::render('Admin', 'settingsIsActive');
                        break;
                    case 'general':
                        View::render('Admin', 'settingsGeneral');
                        break;
                    default:
       					require_once('/system/admin/templates/settings.php');
                        break;
                }
                break;
            default:
       			require_once('/system/admin/templates/dashboard.php');
          		break;
        }
    }

	public function settings()
	{

        $url = View::explodeLink();
        if(!isset($url[2])) $url[2] = "";
        if(!isset($url[3])) $url[3] = "";

        switch ($url[2]) {
            case 'onoff':
                require_once('system/admin/templates/settingsOnOff.php');
                break;
        	case 'main':
        		require_once('/system/admin/templates/settingsMain.php');
        		break;
        	
        	default:
        		require_once('/system/admin/templates/settings.php');
        		break;
        }
	}

    public function afterAction()
	{

    }
}