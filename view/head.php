<?php

return new element(array(
	'tag' => 'head',
	'id' => false,
	//Estos son necesarios para el boootstrap...
	// Inicio de las cosas de bootstrap
	new element(array(
		'tag' => 'meta',
		'charset' => 'utf-8',
		'id' => false
	)),
	new element(array(
		'tag' => 'meta',
		'http-equiv' => 'X-UA-Compatible',
		'content' => 'IE=edge',
		'id' => false
	)),
	new element(array(
		'tag' => 'meta',
		'name' => 'viewport',
		'content' => 'width=device-width, initial-scale=1',
		'id' => false
	)),
	new element(array(
		'tag' => 'link',
		'href' => 'css/bootstrap.min.css',
		'rel' => 'stylesheet',
		'id' => false
	)),
	new element(array( // Necesario para BootStrap pero también lo ocuparemos nosotros.
		'tag' => 'script',
		'src' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
		'id' => false
	)),
	new element(array(
		'tag' => 'script',
		'src' => 'js/bootstrap.min.js',
		'id' => false
	)),
	// Fin de las cosas de bootstrap
	new element(array(
		'tag' => 'script',
		'src' => 'js/sol_empleo.js',
		'id' => false
	)),
	new element(array(
		'tag' => 'title',
		'id' => false,
		'_text' => 'Solicitud de empleo electrónica'
	)),
));

?>
