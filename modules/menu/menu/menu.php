<?php
//this is module model
defined('_UOVCA') or die();

class MenuMenu {
	
	function __construct(){
		//only one function here (for now)
		$this->menu();		
	}
	
	private function menu(){
		
		$items = array();
		$menu = Config::get('menu');
		
		
		
		
		
		
		
		
		load::view('items');
	}
}