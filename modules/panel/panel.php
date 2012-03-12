<?php
//this is module controller
defined('_UOVCA') or die();

class Panel {
	function __construct(){//select model
		
		//$page = Page::get();
		
		$model = 'panel';
		
		Framework::loadModel($model);		
	}
}