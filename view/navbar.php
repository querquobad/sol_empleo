<?php

return new element(array(
	'tag' => 'nav',
	'class' => 'navbar navbar-inverse',
	new element(array(
		'tag' => 'div',
		'class' => 'container-fluid',
		new element(array(
			'tag' => 'div',
			'class' => 'navbar-header',
			new element(array(
				'tag' => 'a',
				'class' => 'navbar-brand',
				'href' => 'http://www.getecsa.com.mx',
				'_text' => 'Getecsa',
				'target' => '_blank'
			)),
		)),
		new element(array(
			'tag' => 'div',
			new element(array(
				'tag' => 'ul',
				'class' => 'nav navbar-nav'
			)),
		))
	))
));

?>
