<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}


$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook']['WaplerSystems\\ContextRibbon\\Hooks\\DocumentTemplate'] =
    'WapplerSystems\\ContextRibbon\\Hooks\\DocumentTemplate->preHeaderRenderHook';


$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['configArrayPostProc']['WaplerSystems\\ContextRibbon\\Hooks\\Frontend'] = 'WapplerSystems\\ContextRibbon\\Hooks\\Frontend->frontendHook';
