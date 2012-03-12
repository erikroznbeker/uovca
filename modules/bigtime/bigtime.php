<?php
//this is module controller
defined('_UOVCA') or die();

class Bigtime {
	function __construct(){//select model
	
		$model = 'clock';
		
		Framework::loadModel($model);		
	}
}