<?php

class input extends element {
	private $label;
	private $div;
	public function __construct($att) {
		if (isset($att['tag']) && $att['tag'] !== 'input') throw new RuntimeException('No se puede crear un elemento '.$att['tag'].' con la clase input');
		$att['tag'] = 'input';
		parent::__construct($att);
		$this->addClass('form-control');
		if (isset($att['label']) && is_string($att['label'])) {
			if ($att['id'] === false) {
				$this->atributos['id'] = $this->tag.'_'.self::$num_element;
			}
			$this->label = new element(array(
				'tag' => 'label',
				'_text' => $att['label'],
				'for' => $this->atributos['id']
			));
			unset($this->atributos['label']);
		}
	}
	public function render() {
		/*
		 * En el caso que $div YA SEA UN element significa que nos está llamando él para renderearse
		 * Tambien no rendereamos en el caso que no tengamos un label (tal vez no habra label y seamos nosotros solitos)
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
