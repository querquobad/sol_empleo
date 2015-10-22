<?php

abstract class abstractDB {
	private static $db_host = 'localhost';
	private static $db_user = 'root';
	private static $db_pass = '533DSviX';
	private static $db_name = 'sol_empleo';
	protected $arguments = array();
	private $conn;

	abstract protected function get();
	abstract protected function set();
	abstract protected function edit();
	abstract protected function del();

	function __construct() {
		$this->conn = new mysql_db(self::$db_host, self::$db_user,
		self::$db_pass, self::$db_name);
	}

	function __destruct() {
		$this->conn->close();
	}

	protected function query($sql,$args) {
		return $this->conn->query_all($sql,$args);
	}

}

?>
