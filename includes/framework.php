<?php
defined('_UOVCA') or die();

class Framework {
	
	public function __construct() {
		
		//include files
		load::_('configuration'); //load template class
		load::_('inc.session'); //load session class
		load::_('inc.page'); //load session class
		load::_('inc.utils'); //load utils class
		load::_('lib.user.user'); //load user class
		load::_('lib.database.pg'); //load database class
		load::_('lib.database.qbuilder'); //load query builder class
		load::_('lib.template.template'); //load template class
		
		$this->loadDebug();
		
		//run init functions
		Session::start();
		Page::set();
		User::init();
	}
	
	public static function loadModel($modelName){
		
		$moduleName = load::getCaller(debug_backtrace());
		
		load::model($moduleName, $modelName);
		$modelclass = $moduleName.$modelName;
		new $modelclass;
	}
	
	private function loadDebug(){
		if(Config::get('debug')==false)return false;
		else{
			load::_('inc.PhpConsole'); //load session class
			PhpConsole::start();
		}
	}
	
	

}
 $fw = new Framework; //go!
