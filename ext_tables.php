<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}


$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/template.php']['preHeaderRenderHook']['WaplerSystems\\ContextRibbon\\Hooks\\DocumentTemplate'] =
    'WapplerSystems\\ContextRibbon\\Hooks\\DocumentTemplate->preHeaderRenderHook';