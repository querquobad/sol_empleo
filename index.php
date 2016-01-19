<?php
require_once('autoload.php');
require_once('sesiones.php');
$html = new element(array(
	'tag' => 'html',
	'lang' => 'es',
	'id' => false,
	include('view/head.php'), //El encabezado <head>
	new element(array(
		'tag' => 'body',
		'id' => false,
		include('view/navbar.php')
	))
));

$html->getElementByTag('body')->addElement(include('view/modal.php')); //Finalmente esto lo usaremos bastante sin importar si ya se hizo login.
$html->getElementByTag('body')->addElement(new element(array( // Este es el container principal
	'tag' => 'div',
	'id' => 'bt-container',
	'class' => 'container-fluid',
)));
if (!(isset($_SESSION['usuario']) && is_a($_SESSION['usuario'],'usuario'))) {
	// Si no tenemos sesión nos vamos a identificar
	$html->getElementById('bt-container')->addElement(include('view/login.php'));
	$html->getElementByTag('head')->addElement(new element(array(
		'tag' => 'script',
		'src' => 'js/login.js',
		'type' => 'text/javascript',
		'id' => false
	)));
} else {
	/*
	 * Supuestamente si tenemos una sesión activa (o por lo menos un email)
	 * Por lo que ya hay menú
	 */
	$html->getElementById('bt-container')->addElement(
		new element(array(
			'id' => 'menu_usuario',
			'tag' => 'div',
			new element(array(
				'tag' => 'ul', // Aqui se agregan los elementos del menú
				'class' => 'nav nav-tabs', //BootStrap tabs

			))
		))
	);
	$html->getElementById('bt-container')->addElement(new element(array(
		'tag' => 'div',
		'class' => 'tab-content',
		'id' => 'tab-content'
	))); //Aqui va el contenido de los tabs
	foreach($_SESSION['usuario']->getMenu() as $value) {
		$active = true;
		/*
		 * Agregamos el contenido y el menu
		 */
		try {
			$html->getElementById('tab-content')->addElement(new element(array(
				'tag' => 'div',
				'id' => $value['leyenda'],
				'class' => 'tab-pane fade',
				include_once('view/'.stripAccents($value['leyenda']).'.php') //Si el archivo no existe debe arrojar ErrorException
			)));
			if($active) {
				$html->getElementById($value['leyenda'])->addAtributo('class','in active');
				$active = false; // Esto es únicamente para el primer tab
			}
			// Si hemos llegado aqui el archivo existe y por lo tanto podemos agregar el menu
			$html->getElementById('menu_usuario')->getElementByTag('ul')->addElement(new element(array(
				'tag' => 'li',
				new element(array(
					'tag' => 'a',
					'data-toggle' => 'tab',
					'href' => '#'.$value['leyenda'],
					'_text' => $value['leyenda']
				))
			)));
		} catch (ErrorException $e) {
			error_log('No se encontró el archivo view/'.stripAccents($value['leyenda']).'.php');
		}
	}
	$html->getElementById('menu_usuario')->getElementByTag('ul')->getElementByTag('li')->addAtributo('class','active'); //El primer li en el primer ul en el menu
}
echo '<!DOCTYPE html>'."\n";
echo $html->render();

?>
