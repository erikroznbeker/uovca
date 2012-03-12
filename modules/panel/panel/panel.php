<?php
//this is module model
defined('_UOVCA') or die();

class PanelPanel {
	
	function __construct(){
		//only one function here (for now)
		$this->panel();		
	}
	
	private function panel(){
		load::view('panel');
	}
}