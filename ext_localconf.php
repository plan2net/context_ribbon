<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
(static function () {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['renderPreProcess']['WaplerSystems\\ContextRibbon\\Hooks\\Ribbon'] = \WapplerSystems\ContextRibbon\Hooks\Ribbon::class . '->setRibbonForBackend';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['configArrayPostProc']['WaplerSystems\\ContextRibbon\\Hooks\\Ribbon'] = \WapplerSystems\ContextRibbon\Hooks\Ribbon::class . '->setRibbonForFrontend';
})();
