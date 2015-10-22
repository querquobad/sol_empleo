<?php
//Autoload de clases
spl_autoload_register(function($clase) {//Funcion anónima JavaScriptStyle
	include_once('clases/'.$clase.'.php');
});

?>
