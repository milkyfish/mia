<?php
use DB\DB as DB;

class AdminModel extends Model {

	function __construct() {
		
	}

	public static final function getStats() {
		$db = new DB();
		$db->bind('name', 'coreVersion');
		$data = $db->query('SELECT * FROM mia_settings WHERE name = :name');
		$modules = $db->query('SELECT COUNT(*) FROM mia_modules');
		$errors = $db->query('SELECT COUNT(*) FROM mia_errors');
		$db->bind('name2', 'notes');
		$notes = $db->query('SELECT * FROM mia_settings WHERE name = :name2');
		$res['coreVersion'] = $data[0]['value'];
		$res['modules'] = $modules[0]['COUNT(*)'];
		$res['errors'] = $errors[0]['COUNT(*)'];
		$res['notes'] = $notes[0]['value'];
		return $res;
	}

	public static final function getMainSettings() {
		$db = new DB();
		$db->bind('group_id', '0');
		$data = $db->query('SELECT * FROM mia_settings WHERE group_id = :group_id');
		
		$res = array();
		foreach ($data as $value) {
			switch ($value['name']) {
				case 'projectName':
					$res['projectName'] = $value['value'];
					break;
				case 'projectDescription':
					$res['projectDescription'] = $value['value'];
					break;
				case 'projectCharset':
					$res['projectCharset'] = $value['value'];
					break;
				case 'projectRobots':
					$res['projectRobots'] = $value['value'];
					break;
				case 'cssLibraries':
					$res['cssLibraries'] = $value['value'];
					break;
				case 'jQueryLibrary':
					$res['jQueryLibrary'] = $value['value'];
					break;
				default:
					break;
			}
		}

		return $res;
	}

	public static final function addMainSettings($projectName, $projectDescription, $projectCharset, $projectRobots, $cssLibraries, $jQueryLibrary) {
		$db = new DB();
		$db->query("UPDATE mia_settings SET value = :projectName WHERE name = 'projectName'", array('projectName'=> $projectName));
		$db->query("UPDATE mia_settings SET value = :projectDescription WHERE name = 'projectDescription'", array('projectDescription'=> $projectDescription));
		$db->query("UPDATE mia_settings SET value = :projectCharset WHERE name = 'projectCharset'", array('projectCharset'=> $projectCharset));
		$db->query("UPDATE mia_settings SET value = :projectRobots WHERE name = 'projectRobots'", array('projectRobots'=> $projectRobots));
		$db->query("UPDATE mia_settings SET value = :cssLibraries WHERE name = 'cssLibraries'", array('cssLibraries'=> $cssLibraries));
		$db->query("UPDATE mia_settings SET value = :jQueryLibrary WHERE name = 'jQueryLibrary'", array('jQueryLibrary'=> $jQueryLibrary));
	}

	public static final function getOnOffSettings() {
		$db = new DB();
		$db->bind('group_id', '1');
		$data = $db->query('SELECT * FROM mia_settings WHERE group_id = :group_id');

		$res = array();
		foreach ($data as $value) {
			switch ($value['name']) {
				case 'isActive':
					$res['isActive'] = $value['value'];
					break;
				case 'inActiveMessage':
					$res['inActiveMessage'] = $value['value'];
					break;
				default:
					break;
			}
		}

		return $res;
	}

	public static final function addOnOffSettings($isActive, $inActiveMessage) {
		$db = new DB();
		$db->query("UPDATE mia_settings SET value = :isActive WHERE name = 'isActive'", array('isActive'=> $isActive));
		$db->query("UPDATE mia_settings SET value = :inActiveMessage WHERE name = 'inActiveMessage'", array('inActiveMessage'=> $inActiveMessage));
	}
}