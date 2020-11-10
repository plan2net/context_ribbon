<?php

defined('TYPO3_MODE') or die('Access denied.');

(static function () {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['renderPreProcess'][\WapplerSystems\ContextRibbon\Hooks\Ribbon::class] = \WapplerSystems\ContextRibbon\Hooks\Ribbon::class . '->setRibbonForBackend';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['configArrayPostProc'][\WapplerSystems\ContextRibbon\Hooks\Ribbon::class] = \WapplerSystems\ContextRibbon\Hooks\Ribbon::class . '->setRibbonForFrontend';
})();
