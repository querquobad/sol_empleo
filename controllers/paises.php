<?php

class paises {
	private $paises=array();

	public function __construct() {
		$conn = new mysql_db('localhost','sol_empleo','sol.empleo','sol_empleo');
		$recs = $conn->query_all(
			'SELECT id,pais,codigo '.
			'FROM paises ',array()
		);
		foreach($recs as $value) $this->paises[$value['id']] = array(
			'pais' => $value['pais'],
			'codigo' => $value['codigo']
		);
	}

	public function __get($codigo) {
		if(isset($this->paises[$codigo])) return $this->paises[$codigo];
	}

	public function get($sel = 152) {
		if(!is_int($sel)) $sel = 152; //Mexico es el default
		$retval = array();
		foreach($this->paises as $key => $value) {
			if($key === $sel) {
				$retval[] = array(
					'pais' => $value['pais'],
					'codigo' => $value['codigo'],
					'selected' => true
				);
			} else {
				$retval[] = array(
					'pais' => $value['pais'],
					'codigo' => $value['codigo'],
					'selected' => false
				);
			}
		}
		return $retval;
	}
}

?>
