<?php

require_once('../autoload.php');
require_once('../sesiones.php');
class Usuariocontroller extends abstractDB {
	public $nombre;
	public $apellido;
	public $email;
	private $password;
	protected $id;
	private $rows;

	public function get($request=array()) {
		$user_email = $request['email'];
		if($user_email != '') {
			$this->rows = $this->query('
			SELECT '.
				'id, email, password '.
			'FROM '.
				'usuarios '.
			'WHERE '.
				'email = ?',array($_POST['email']));
			if (!is_array($this->rows) || count($this->rows) == 0) {
				throw new RuntimeException('Usuario no encontrado');
			}
			//Tecnicamente el email es único por lo que sólo obtendremos un registro
			return $this->rows;
		} else {
			throw new RuntimeException('E-Mail vacío');
		}
	}

	public function set($user_data=array()) {
		if(array_key_exists('email', $user_data)) {
			$this->get($user_data['email']);
			if($user_data['email'] != $this->email) {
				foreach ($user_data as $campo=>$valor) {
					$$campo = $valor;
				}
				$this->query_all('INSERT INTO usuarios (email, password) '.
						'VALUES (?, PASSWORD(?))',array());
				$this->mensaje = 'Usuario agregado exitosamente';
			} else {
				$this->mensaje = 'El usuario ya existe';
			}
		}
	}

	public function edit($user_data=array()) {
		foreach ($user_data as $campo=>$valor) {
			$$campo = $valor;
		}
		$this->query = 'UPDATE usuarios '.
				'SET nombre=?, '.
				'apellido=? '.
				'WHERE email = ?';
	}

	public function del($user_email='') {
		$this->query = 'DELETE FROM usuarios '.
				'WHERE email = ?';
	}

	public function login ($args){
		$retval =  $this->query('SELECT PASSWORD(?) = password as login FROM usuarios WHERE email = ?',array($args['password'],$args['email']));
		if ($retval[0]['login'] == '1') {
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['admin'] = true;
		} else {
			throw new RuntimeException('Login inválido');
		}
		return $retval;
	}
}
require_once('aspirantes.php');
$user = new Usuariocontroller();
if (isset($_POST['request'])) {
	try {
		$datos = call_user_func(array($user,$_POST['request']),$_POST);
		if (is_array($datos)) $datos[0]['admin'] = true;
	} catch (RuntimeException $e) {
		$user = new Aspirantecontroller();
		$datos = call_user_func(array($user,$_POST['request']),$_POST);
	}
	if (!is_array($datos)) throw new RuntimeException('No existe propiedad');
} else {
	throw new RuntimeException('request vacío');
}
$retval = array('data' => $datos);
$json = json_encode(array('data' => $datos));
if ($json === false) {
	error_log(json_last_error_msg());
	foreach ($datos as &$dato_actual) foreach ($dato_actual as &$dato_real) $dato_real = utf8_encode($dato_real);
	$json = json_encode(array('data' => $datos));
	if (!$json) throw new RuntimeException('Error JSON:'.json_last_error_msg());
}
echo $json

?>
