<?php

class rest {
	private $request_type;
	private $args = array();

	function __construct() {
		$this->request_type = $_SERVER['REQUEST_METHOD'];
		switch ($this->request_type) {
			case 'GET':
				$this->args = $_GET;
				break;
			case 'POST':
				$this->args = $_POST;
				break;
			default:
				$this->args = $_REQUEST;
		}
	}

	function getType() {
		return strtolower($this->request_type);
	}

	function getArgs() {
		return $this->args;
	}

	function response($response) {
		if (is_array($response)) {
			return json_encode($response);
		} else {
			return json_encode(array($response));
		}
	}
}

?>
