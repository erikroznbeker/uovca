<?php
//this is module model
defined('_UOVCA') or die();

class LoginLogout {
	
	function __construct(){
		$this->logout();		
	}
	
	private function logout(){
		
		User::logout();
		Page::redirect();
		
	}
}