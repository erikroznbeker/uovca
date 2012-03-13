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
		
		foreach($menu as $item){			
			if(!isset($item['hidden']) || !$item['hidden']){
				$items[] = $item;
			}
		}
		
		print_r($items);
		
		
		
		
		
		
		load::view('items');
	}
}