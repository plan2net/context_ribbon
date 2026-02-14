<?php

$EM_CONF['context_ribbon'] = [
    'title' => 'Context Ribbon',
    'description' => 'Shows a ribbon in the right top corner of the backend and frontend depending on the TYPO3 application context',
    'author' => 'Sven Wappler, Ioulia Kondratovitch',
    'author_email' => 'typo3YYYY@wapplersystems.de, ik@plan2.net',
    'category' => 'backend',
    'author_company' => 'WapplerSystems, plan2net',
    'state' => 'stable',
    'version' => '14.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.99.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];
