<?php

class form extends element {
	private $tipo = 'vertical';

	public function __construct($att=array()) {
		if (isset($att['tag']) && $att['tag'] !== 'form') throw new RuntimeException('No se puede crear un elemento '.$att['tag'].' con la clase form');
		$att['tag'] = 'form';
		parent::__construct($att);
		if (in_array('role',$this->atributos)) {
			if ($this->atributos['tipo'] === 'horizontal' || $this->atributos['tipo'] === 'inline') {
				$this->tipo = $this->atributos['tipo'];
				unset($this->atributos['tipo']);
				$this->addClass('form-'.$this->tipo);
			}
		}
		$this->addAtributo('role','form');
	}
}

?>
