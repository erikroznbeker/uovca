<?php
defined('_UOVCA') or die();

class load {
	
	/*public function __construct() {
		spl_autoload_register(array($this, 'loader'));
	}*/
	
	public static function _($path){
		
		$find = array('inc.','lib.', 'tmpl.','.');
		$replace =array('includes/', 'libraries/', 'templates/', '/');
		
		
		$path = str_replace($find, $replace, $path).'.php';
		
	//	echo 'trying to load '.$path.': ';
		
		if(file_exists($path)) {
			include $path;
			//echo 'Success';
		}
		//else 'ERROR!';
	}
	
	public static function module($modname){
		self::_('modules.'.$modname.'.'.$modname);
	}
	
	public static function model($moduleName, $modelName){
		self::_('modules.'.$moduleName.'.'.$modelName.'.'.$modelName);
	}
	
	public static function view($viewName){
		$viewPath = self::getCaller(debug_backtrace(), true);
		self::_($viewPath.'.'.$viewName.'.'.$viewName);
	}
	
	
	/*public function moduleTmpl($modname){
		self::_('modules.'.$modname.'.tmpl');
	}*/
	
	public static function getCaller($debug_backtrace, $callerDir=false){
		
		if($callerDir){
			return dirname($debug_backtrace[0]['file']);
		}
		else{
			$file = $debug_backtrace[0]['file'];
			$file = explode('.', basename($file));
			array_pop($file);
			return implode('.', $file);
		}
	}
	
	
	
	//private function loader($className) {
		//echo 'Trying to load ', $className, ' via ', __METHOD__, "()\n";
		/*$file = $this->paths(strtolower($className));
		if(file_exists($file)) include $file;
		else echo 'ERROR: Autoloader: '.$file.' does not exists!';*/
	//}
	
	/*private function paths($className){
		$classes = array(
			'framework'=>PATH.'/include/framework.php',
			'user'=>PATH.'/libraries/user/user.php'
		);
		
		return (isset($classes[$className]))?$classes[$className]:PATH.'/'.$className.'.php';
	}*/
}

//init loader
//new load();
