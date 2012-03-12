<?php
//mark main file
define('_UOVCA', 1);

//define absolute path
define('PATH', dirname(__FILE__));

//load loader
require_once(PATH.'/includes/load.php');

//load framework class for bootstraping
load::_('inc.framework');

echo Template::display();












//echo PATH;
//echo "<pre>";
//print_r($_SERVER);




//require()
