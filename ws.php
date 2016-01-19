<?php

require_once('autoload.php');
require_once('sesiones.php');
$req = new rest();
$args = $req->getArgs();
$obj = new $args['request']($args);
$tipo = $req->getType();
if (!isset($args['action'])) {
	echo $req->response($obj->$tipo($args));
} else {
	echo $req->response($obj->$args['action']($args));
}

?>
