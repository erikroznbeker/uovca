<?php
defined('_UOVCA') or die();
?>
<html>
  <head>
  	<base href="<?php echo Page::url()?>">
    <meta charset="utf-8">
    <title>{pagetitle}</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Page::url('css')?>/uovca.css" />
    <script src="<?php echo Page::url('js')?>/jquery-1.7.1.min.js"></script>
    <script src="<?php echo Page::url('js')?>/util.js"></script>
    {js}
  </head>
  <body>
  <div id="wrapper">
  	<?php if(Template::show('header')):?>
		<div id="header">
			{module::bigtime}
			<div id="menu">
				{-module::menu}
			</div>
		</div>
	<?php endif;?>
		<div id="content">
			{::main}
		</div>
	<?php if(Template::show('footer')):?>
  		<div id="footer">
  			{-module::footer}
  		</div>
  	<?php endif;?>
  </div>
  
  <?php /*?>
  <pre>
  <? print_r($_SESSION);?>
  
  <hr>
  
  <?php 
  
  
  
  */ 	?>
  </pre>
  </body>
</html>
