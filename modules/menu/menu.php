<?php
//this is module controller
defined('_UOVCA') or die();

class Menu {
	function __construct(){//select model
		
		//$page = Page::get();
		
		$model = 'menu';
		
		Framework::loadModel($model);		
	}
}