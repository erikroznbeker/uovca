<?php
defined('_UOVCA') or die();

class User {
	
	public static function init(){
		$user = self::get();
		if(!isset($user->id) || !isset($user->user_group_id) || !isset($user->name))self::setGuest();
	}
	
	public static function setGuest(){
		$user = array(
			'id'=>0,
			'name'=>'Gost',
			'username'=>'',
			'user_group_id'=>0
		);
		Session::set('user', $user);
	}
	
	
	public static function get(){
		return (object)Session::get('user');
	}
	
	public static function logout(){
		self::setGuest();
		setcookie("uovcaal", 0, 0, "/");//destroy autologin
	}
	
	public static function loggedIn(){
		$user = self::get();
		if($user->id)return true;
		else return false;
	}
	
	private static function setUser($userObject){
		
		if(!isset($userObject) || !$userObject->id || !$userObject->name || !$userObject->username || !$userObject->user_group_id)return false;
		else{
			$user = array(
				'id'=>$userObject->id,
				'name'=>$userObject->name,
				'username'=>$userObject->username,
				'user_group_id'=>$userObject->user_group_id
			);
			Session::set('user', $user);
		}
	}
	
	public static function login($post){
			
		if(!$post->username || !$post->password)return false;
				
		//$db = Db::getInstance();
		$user = Db::getRow(array(
			'from'=>'__user',
			'where'=>array('username'=>$post->username)
		));
			
		if(!$user || !$user->id || !$user->username || !$user->password)return false; //username ne postoji
		else{ //username postoji provjeri lozinku
			
			$salt = strstr($user->password, ':', true);
			$saltedPass = md5($salt.$post->password);
				
			if($salt.':'.$saltedPass != $user->password) return false; //lozinka nije točna
			else{ //ulogiraj me :)			
				self::setUser($user);
				
				if(isset($post->rememberme) && $post->rememberme){//set autologin
					$autologinHash = Util::encript($user->username.'|~|'.$salt);
					setcookie("uovcaal", $autologinHash, time()+(60*60*24*7), "/");//valid for 7 days
				}
				return true;
			}
		}
	}
	
	public static function autologin(){
		
		if(self::loggedIn())return true;
		else{
			if(!isset($_COOKIE['uovcaal']) || !$_COOKIE['uovcaal'])return false;
			else{
				$al = Util::decript($_COOKIE['uovcaal']);
				list($username, $salt) = explode('|~|', $al);
				if(!$username || !$salt)return false;

				$user = Db::getRow(array(
					'from'=>'__user',
					'where'=>array(
						'username'=>$username,
						'password,rLike'=>$salt
					)
				));
				
				if(!$user || !$user->id || !$user->username || !$user->password)return false; //username ne postoji
				else{
					self::setUser($user);
					return true;
				}
			}
		
		}
	}
}
