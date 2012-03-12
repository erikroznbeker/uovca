<?php
defined('_UOVCA') or die();

class Util {
	static function getPost(){
		$post = array();
		if(count($_POST)){
			foreach ($_POST as $key=>$val){
				$post[$key]=(is_string($val))?trim($val):$val;
			}
		}
		return (object) $post;
	}
	
	static function encript($text){
		if(!$text)return '';
		
		$crypt = Config::get('crypt');
		return openssl_encrypt($text, $crypt->method, $crypt->secret, 0, $crypt->iv);
	}
	
	static function decript($excriptedText){
		if(!$excriptedText)return '';
		
		$crypt = Config::get('crypt');
		return openssl_decrypt($excriptedText, $crypt->method, $crypt->secret, 0, $crypt->iv);
	}
	
	static function arrayToObject($array) {
		if(!is_array($array)) {
			return $array;
		}
	
		$object = new stdClass();
		if (is_array($array) && count($array) > 0) {
			foreach ($array as $name=>$value) {
				$name = strtolower(trim($name));
				if (!empty($name)) {
					$object->$name = self::arrayToObject($value);
				}
			}
			return $object;
		}
		else {
			return FALSE;
		}
	}
}