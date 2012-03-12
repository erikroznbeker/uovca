<?php
//this is module view
defined('_UOVCA') or die();

Template::loadJs(Page::myUrlDir().'/login.js');
Template::setTitle('Prijava')
?>

<div id="login">

<div id="tooltip">Pogrešno korisničko ime ili lozinka.</div>

<h1>UOVCA</h1>

<form action="<?php echo Page::url()?>" method="post">
	<label id="label_username">Ime</label>
	<input type="text" name="username" class="input" id="username" />
	
	<label id="label_password">Lozinka</label>
	<input type="password" name="password" class="input" id="password" />
	
	<label id="label_rememberme">Zapamti me</label>
	<input type="checkbox" name="rememberme" class="checkbox" id="rememberme" checked="checked" />
	
	<input type="submit" id="button_submit" value="Prijava">
</form>
<div class="clr"></div>

</div>


