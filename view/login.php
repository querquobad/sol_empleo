<?php

return new form(array(
	'method' => 'POST',
	'id' => 'frm_login',
	new input(array(
		'type' => 'text',
		'autocomplete' => 'off',
		'name' => 'username',
		'id' => 'username',
		'label' => 'E-Mail: ',
	)),
	new element(array(
		'tag' => 'button',
		'type' => 'submit',
		'id' => 'btn_email_login',
		'_text' => 'Ingresar'
	))
));

?>
