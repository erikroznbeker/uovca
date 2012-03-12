<?php
//this is module controller
defined('_UOVCA') or die();

class Login {
	function __construct(){//select model
		
		$page = Page::get();
		
		if($page=='logout')$model = 'logout';
		else $model = 'form'; // login form
		
		Framework::loadModel($model);		
	}
}