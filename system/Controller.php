<?php
use Inflection\Inflection as Inflection;
use View\View as View;

class Controller {
	
	protected $_controller;
	protected $_action;
	protected $_view;

	public $doNotRenderHeader;
	public $render;

	function __construct($controller, $action) {
		
		$inflect = new Inflection();

		$this->_controller = ucfirst($controller);
		$this->_action = $action;
		
		$model = ucfirst($inflect->singularize($controller)).'Model';
		$this->doNotRenderHeader = 0;
		$this->render = 1;
		if($model == 'AdminModel')
			require_once(fileDir.'/system/admin/'.$model.'.php');
		else
			require_once(fileDir.'/app/models/'.$model.'.php');
		$this->$model = new $model;
		$this->_view = new View($controller,$action);

	}

	function set($name,$value) {
		$this->_view->set($name,$value);
	}
	/*
	function __destruct() {
		if ($this->render) {
			$this->_view->render($this->doNotRenderHeader);
		}
	}
	*/
}