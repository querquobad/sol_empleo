<?php

class usuario{
	private $id;
	private $perfil;
	private $email;
	private $nombre_perfil;

	function __construct($args=array()) {
		// Necesitamos el la base de datos.
		$conn = new mysql_db('localhost','sol_empleo','sol.empleo','sol_empleo');
		/*
		 * Si ya tenemos un usuario en la sesión lo regresamos de lo contrario generamos uno
		 */
		if (isset($_SESSION['usuario']) && is_a($_SESSION['usuario'],'usuario')) return $_SESSION['usuario']; 
		/*
		 * Esto trata de validar si el usuario es efectivamente un 'usuario' o es un 'aspirante'
		 * Como son dos tablas tenemos que unirlas
		 */
		if (!isset($args['email'])) throw new RuntimeException('Argumentos inválidos para nuevo usuario');
		$recs = $conn->query_all(
		'SELECT * FROM ('.
				'SELECT a.id, email, \'1\' AS usuario, a.perfil, b.perfil as nombre_perfil '.
					'FROM usuarios a LEFT JOIN perfiles b on a.perfil = b.id '.
			'UNION '.
				'SELECT id, email, \'0\' AS usuario, ('.
					'SELECT id FROM perfiles WHERE perfil = \'aspirante\''.
				') as perfil, \'aspirante\' as nombre_perfil '.
				'FROM aspirantes'.
		') o WHERE o.email = ?',array($args['email']));
		if (count($recs) > 1) throw new RuntimeException('E-Mail duplicado'); //Esto en el caso de que el email esté en ambas tablas
		$this->id = $recs[0]['id'];
		$this->email = $recs[0]['email'];
		$this->perfil = $recs[0]['perfil'];
		$this->nombre_perfil = $recs[0]['nombre_perfil'];
	}

	function get($request=array()) {
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

	function set($user_data=array()) {
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

	function edit($user_data=array()) {
		foreach ($user_data as $campo=>$valor) {
			$campo = $valor;
		}
		$this->query = 'UPDATE usuarios '.
				'SET nombre=?, '.
				'apellido=? '.
				'WHERE email = ?';
	}

	function del($user_email='') {
		$this->query = 'DELETE FROM usuarios '.
				'WHERE email = ?';
	}

	public function login ($args=array()){
		$conn = new mysql_db('localhost','sol_empleo','sol.empleo','sol_empleo');
		$retval =  $conn->query_all('SELECT PASSWORD(?) = password as login FROM usuarios WHERE email = ?',array($args['password'],$args['email']));
		if ($retval[0]['login'] == '1') {
			$_SESSION['usuario'] = $this;
		}
		return $retval[0];
	}

	public function validaUsuario($args=array()) {
		if ($this->nombre_perfil == 'aspirante') return false;
		return true;
	}
}

?>
