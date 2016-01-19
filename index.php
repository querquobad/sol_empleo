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
				'tag' => 'table' // Aqui se agregan los elementos del menú
			))
		))
	);
	foreach($_SESSION['usuario']->getMenu() as $value) {
		$html->getElementById('menu_usuario')->getElementByTag('table')->addElement(new element(array(
			'tag' => 'td',
			'data-menuId' => $value['id'],
			'_text' => $value['leyenda']
		)));
	}

}
echo '<!DOCTYPE html>'."\n";
echo $html->render();

?>
