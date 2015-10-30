<?php

require_once('../autoload.php');
require_once('../sesiones.php');
class Aspirantecontroller extends abstractDB {
	protected $id;
	private $rows;

	public function get($request=array()) {
		$arr_sql = array();
		$sql = 'SELECT '.
				'a.id, a.nombre, CONCAT_WS(\' \',a.paterno, a.materno) AS apellidos, a.fecha_nacimiento, if(a.sexo=true,\'1\',\'0\') as sexo, a.email, '.
				'b.pais AS nacionalidad, c.pais AS lugar_nacimiento, d.religion as religion, e.estado_civil, f.tipo_casa, g.vivienda_compartida '.
			'FROM '.
				'aspirantes a '.
			'LEFT JOIN paises b on a.nacionalidad = b.id '.
			'LEFT JOIN paises c on a.lugar_nacimiento = c.id '.
			'LEFT JOIN religiones d ON a.religion = d.id '.
			'LEFT JOIN estados_civiles e ON a.estado_civil = e.id '.
			'LEFT JOIN tipos_casas f ON a.tipo_casa = f.id '.
			'LEFT JOIN cat_vivienda_compartida g ON a.vivienda_compartida_con = g.id';
		if (isset($request['email'])) {
			$sql .= ' WHERE a.email = ?';
			$arr_sql[] = $request['email'];
		}
		$this->rows = $this->query($sql,$arr_sql);
		if (!is_array($this->rows)) throw new RuntimeException('Error SQL');
		return $this->rows;
	}
	public function set() {
		return null;
	}

	public function edit() {
		return null;
	}

	public function del() {
		return null;
	}
	public function login ($args){
		$retval =  $this->query('SELECT * FROM aspirantes WHERE email = ?',array($args['email']));
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['admin'] = false;
		return $retval;
	}
}

?>
