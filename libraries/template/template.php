<?php
defined('_UOVCA') or die();

class Template {
	public static function display(){

		$mainModule = null;
		$positions = array('all'=>true);
		
		if(!User::loggedIn()){//not logged in
			$mainModule = 'login';
			$positions = array('main'=>true, 'header'=>false, 'footer'=>false);
		}
		Session::set('positions', $positions);
		
		//load template
		ob_start();
			load::_('tmpl.main.index');
		$template = ob_get_contents();
		ob_end_clean();
		
		//main module
		$mainModule = ($mainModule)?$mainModule:Page::getMainModule();
		$settings = self::getSettings();
		$template = str_replace('{::main}', self::getModule($mainModule)."\n".$settings, $template);
		
		//modules
		if(preg_match_all('/{module::\w+}/', $template, $modules)){
			foreach($modules[0] as $module){				
				$mod = self::getModule($module);				
				$template = str_replace($module, $mod, $template);
			}
		}
		
		//title
		$template = str_replace('{pagetitle}', self::getTitle(), $template);
		
		//javascript
		$template = str_replace('{js}', self::getJavascript(), $template);
		
		return $template;
		
	}
	
	private static function getModule($modname){
		if(!$modname)return false;
		
		$modname = str_replace(array('{module::', '}'), '', $modname);
		
		ob_start();
			load::module($modname);
			new $modname;
		$moduleOutput = ob_get_contents();
		ob_end_clean();
		
		return $moduleOutput;
	}
	
	public static function show($position){
		if(!$position)return false;
		
		$positions = Session::get('positions');
		if($positions && ((isset($positions[$position]) && $positions[$position]) || (isset($positions['all']) && $positions['all'])))return true;
		else return false;
	}
	
	private static function getTitle(){
		$siteTitile = Config::get('siteTitle');
		$moduleTitle = Session::get('title');
		Session::set('title', '');
	
		return (($moduleTitle)?$moduleTitle.' &bull; ':'').$siteTitile;
	}
	
	public static function setTitle($title){
		Session::set('title', $title);
	}
	
	private static function getJavascript(){
		$out = '';
		$jsList = Session::get('jslist');
		if($jsList && is_array($jsList) && count($jsList)){
			foreach($jsList as $js){
				$out.= '<script src="'.$js.'"></script>'."\n";
			}
		}
		Session::set('jslist', '');
		return $out;
	}
	
	public static function loadJs($jsUrl){
		$jsList = Session::get('jslist');
		if(!$jsList || !is_array($jsList))$jsList = array();
		$jsList[] = $jsUrl;
		Session::set('jslist', $jsList);
	}
	
	public static function setSettings($key, $val){
		$pageSettings =  Session::get('page_setings');
		if(!$pageSettings || !is_array($pageSettings) || !count($pageSettings))$pageSettings = array();
		$pageSettings[$key]=$val;
		Session::set('page_setings', $pageSettings);
	}
	
	public static function getSettings(){
		$pageSettings =  Session::get('page_setings');
		Session::set('page_setings', '');
		if(!$pageSettings || !is_array($pageSettings) || !count($pageSettings))return null;
		else return '<input type="hidden" id="settings" value=\''.json_encode($pageSettings).'\' />';
	}

}
