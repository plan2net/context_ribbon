<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Context Ribbon',
	'description' => 'Shows a ribbon in the right top corner of the backend and frontend depending on the TYPO3 application context',
	'author' => 'Sven Wappler',
	'author_email' => 'typo3YYYY@wapplersystems.de',
	'category' => 'backend',
	'author_company' => 'WapplerSystems',
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 1,
	'version' => '2.1.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-9.5.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

