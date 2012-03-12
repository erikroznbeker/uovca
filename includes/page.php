<?php
defined('_UOVCA') or die();

class Page {
	
	/**
	* set page, params and current menu item
	*/
	public static function set(){//this is main controller
	
		$menu = Config::get('menu');
		Session::set('page', 'main');//default page value
		Session::set('params', null);//default params value
		if(isset($_GET['page']) && $_GET['page']){
			$page = trim($_GET['page']);
			if(isset($menu) && is_object($menu) && isset($menu->{$page})){
				Session::set('page', $page);
				if(isset($_GET['params']) && $_GET['params'] && strlen(str_replace('/', '', $_GET['params']))>0){
					$params = (object)explode('/', $_GET['params']);
					Session::set('params', $params);
				}
			}
		}
		$page = Session::get('page');
		Session::set('menu', (object) $menu->{$page});
		User::autologin();//try auto login
		self::setUrls();
		
		/*echo "<pre>";
		print_r($_SESSION);
		echo "<hr>";
		print_r($_GET);*/
	}
	
	public static function get($params=false){
		if(!$params)return Session::get('page');
		else Session::get('params');
	}
	
	public static function getMainModule(){
		
		return Session::get('menu')->module;
		
	}
	
	private	static function setUrls() {
		
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://".$_SERVER["SERVER_NAME"];
		$pageURL .= ($_SERVER["SERVER_PORT"] != "80")?":".$_SERVER["SERVER_PORT"]:'';
		$pageURL .= str_replace('index.php', '', $_SERVER["SCRIPT_NAME"]);
		
		Session::set('url', $pageURL);
	}
	
	public static function url($folder=null){
		
		$url =  Session::get('url');
		
		if($folder=='css')return $url.'templates/main/css';
		else if($folder=='js')return $url.'js';
		else return $url;
		
	}
	
	public static function myUrlDir(){
		$debug_backtrace = debug_backtrace();
		$url =  Session::get('url');
		
		return $url.str_replace(PATH.'/', '', dirname($debug_backtrace[0]['file']));
	}
	
	public static function redirect(){
		
		header('location:'.Session::get('url'));
		exit();
		
	}
}