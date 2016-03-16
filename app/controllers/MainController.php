<?php
use View\View as View;

Class MainController extends Controller {
	
	public function __construct() {
	}

    public function beforeAction()
	{

    }

    public function index()
	{
        View::render('Main', 'index');
    }

    public function afterAction()
	{

    }
}