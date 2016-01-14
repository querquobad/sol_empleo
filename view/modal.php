<?php

return new element(array(
	'tag' => 'div',
	new element(array(
		'tag' => 'button',
		'id' => 'btn_modal',
		'class' => 'btn btn-info btn-lg',
		'data-toggle' => 'modal',
		'data-target' => '#modal_wdw',
		'style' => array('display' => 'none')
	)),
	new element(array(
		'tag' => 'div',
		'id' => 'modal_wdw',
		'class' => 'modal fade',
		'role' => 'dialog',
		new element(array(
			'tag' => 'div',
			'class' => 'modal-dialog',
			new element(array(
				'tag' => 'div',
				'class' => 'modal-content',
				new element(array(
					'tag' => 'div',
					'class' => 'modal-header',
					'_text' => 'Getecsa - Solicitud de empleo electr&oacute;nica',
				)),
				new element(array(
					'tag' => 'div',
					'class' => 'modal-body',
					'id' => 'modal-body'
				)),
				new element(array(
					'tag' => 'div',
					'class' => 'modal-footer',
					new element(array(
						'id' => 'modal_close',
						'tag' => 'button',
						'type' => 'button',
						'class' => 'btn btn-default',
						'data-dismiss' => 'modal',
						'_text' => 'Cerrar'
					))
				))
			))
		))
	))
));

?>
