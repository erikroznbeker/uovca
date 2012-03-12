<?php
//this is module model
defined('_UOVCA') or die();

class BigtimeClock {
	
	function __construct(){
		$this->clock();		
	}
	
	private function clock(){
		load::view('clock');
	}
}