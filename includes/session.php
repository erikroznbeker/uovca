<?php
defined('_UOVCA') or die();

class Session {
	public static function start() {
		if(!isset($_SESSION))session_start();
	}
	
	public static function set($key, $val){
		if(!$key)return false;
		else $_SESSION[$key]=$val;
	}
	
	public static function get($key){
		if(!$key || !isset($_SESSION[$key]))return false;
		else return $_SESSION[$key];
	}
}