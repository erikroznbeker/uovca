<?php
//this is module model
defined('_UOVCA') or die();

class LoginForm {
	
	function __construct(){
		//only one function here (for now)
		$this->loginForm();		
	}
	
	private function loginForm(){
		
		if(count($_POST)) $this->login();
		else load::view('form');
	}
	
	private function login(){
		
		$post = Util::getPost();
		
		if(!isset($post->username) || !$post->username || !isset($post->password) || !$post->password || !User::login($post)){
			Template::setSettings('wrongLogin', true);
		}
		Page::redirect();
	}
}