<?php
defined('_UOVCA') or die();

class Config {
	/*site*/
	static $siteTitle = 'uOvca';
	
	/*dev & debug*/
	static $debug = true;
	
	/*database*/
	static $database = array(
		"host" => 'localhost',
		"port" => '5432',
		"database" => 'uovca',
		"schema" => 'uovca',
		"user" => 'postgres',
		"password" => '1234'
	);
	
	/*encription*/
	static $crypt = array(
		"method" => 'AES-256-CBC',
		"secret" => '34b97769a5b8c2563704442965271d00',
		"iv" => '0be762b3127dd273'
	);
	
	/*menu*/
	static $menu = array(
		'main'=>array(
			'label'=>'Naslovnica',
			'module'=>'panel'
		),
		'imenik'=>array(
			'label'=>'Imenik',
			'module'=>'addressbook'
		),
		'klijenti'=>array(
			'label'=>'Klijenti',
			'module'=>'klijenti'
		),
		'korisnici'=>array(
			'label'=>'Korisnici',
			'module'=>'users',
			'hidden'=>true
		),
		'login'=>array(
			'label'=>'Prijava',
			'module'=>'login',
			'hidden'=>true
		),
		'logout'=>array(
			'label'=>'Odjava',
			'module'=>'login',
			'hidden'=>true
		)
	);
	
	
	public static function get($varname){		
		if($varname && isset(self::$$varname)){
			if(is_array(self::$$varname))return (object) self::$$varname;
			else return self::$$varname;
		}
		else return null;
	}
}
