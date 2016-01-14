<?php

class input extends element {
	private $label;
	private $div;
	public function __construct($att) {
		if (!is_a($this,'input') && isset($att['tag']) && $att['tag'] !== 'input')
			throw new RuntimeException('No se puede crear un elemento '.$att['tag'].' con la clase input');
		// Solo sobreescribimos el tag en caso que no exista puede ser una clase hija como select que ya pone un TAG
		if (!isset($att['tag'])) $att['tag'] = 'input'; 
		$this->addAtributo('class','form-control');
		parent::__construct($att);
		if (isset($att['label']) && is_string($att['label'])) {
			if ($this->getAtributo('id') != null) {
				$this->label = new element(array(
					'tag' => 'label',
					'_text' => $att['label'],
					'for' => $this->getAtributo('id')
				));
				unset($att['label']);
			}
		} else if (is_a($att['label'],'element')) {
			$this->label = $att['label'];
		}
	}
	public function render() {
		/*
		 * En el caso que $div YA SEA UN element significa que nos está llamando él para renderearse
		 * Tambien nos rendereamos en el caso que no tengamos un label (tal vez no habra label y seamos nosotros solitos)
		 */
		if (is_null($this->label) || is_a($this->div,'element')) return parent::render();
		// Si $div NO ES un element lo rendereamos metiendonos en medio con nuestra label
		if (!is_a($this->div,'element')){
			$this->div = new element(array(
				'tag' => 'div',
				'class' => 'form-group',
				'id' => false, //quiza debamos de ponerle algo?
				$this->label,
				$this
			));
			return $this->div->render();
		}
	}
}

?>
