<?php

return json_encode(array(
	'manifest_version' => 2,
	'name' => $config['name'],
	'version' => $config['version'],
	'description' => $config['description'],
	'content_scripts' => array(
		array(
			'matches' => $config['patterns'],
			'js' => array('include.js'),
		),
	),
	'icons' => array(
		128 => 'icon.png',
	),
));
