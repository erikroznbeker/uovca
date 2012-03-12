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
			//'access'=>array('0'),
			'module'=>'panel'
		),
		'imenik'=>array(
			'label'=>'Imenik',
			//'access'=>array('0'),
			'module'=>'addressbook'
		),
		'korisnici'=>array(
			'label'=>'Korisnici',
			//'access'=>array('1'),
			'module'=>'users'
		),
		'login'=>array(
			'label'=>'Prijava',
			//'access'=>array('1'),
			'module'=>'login'
		),
		'logout'=>array(
			'label'=>'Odjava',
			//'access'=>array('1'),
			'module'=>'login'
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
