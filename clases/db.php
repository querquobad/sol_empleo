<?php

class db {
	private $db_host = 'localhost';
	private $db_user = 'sol_empleo';
	private $db_pass = 'sol.empleo';
	private $db_name = 'sol_empleo';
	private $conn;


	protected function getJoins($ent) {
		$rels = $this->query('SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = SCHEMA() AND TABLE_NAME = ? AND REFERENCED_TABLE_NAME IS NOT NULL',array($ent));
		foreach ($rels as $rel_actual) {
			$retval[$rel_actual['COLUMN_NAME']] = $rel_actual['REFERENCED_TABLE_NAME'].'.'.$rel_actual['REFERENCED_COLUMN_NAME'];
		}
		return $retval;
	}

	protected function getEntity($ent) {
		$desc = $this->query('DESC '.$ent);
		foreach ($desc as $valor) {
			$retval['campos'][$valor['Field']] = $ent.'.'.$valor['Field'];
			if ($valor['Key'] == 'PRI' || $valor ['Key'] == 'UNI') $retval['Key'][] = $valor['Field'];
		}
		$retval['joins'] = $this->getJoins($ent);
		return $retval;
	}

	function __construct() {
		$this->conn = new mysql_db($this->db_host, $this->db_user,
			$this->db_pass, $this->db_name);
	}

	function __destruct() {
		$this->conn->close();
	}

	public function query($sql,$args=array()) {
		return $this->conn->query_all($sql,$args);
	}

}

?>
