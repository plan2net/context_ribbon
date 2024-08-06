<?php

use WapplerSystems\ContextRibbon\Hooks\Ribbon;

defined('TYPO3') or exit('Access denied.');

(static function () {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/backend.php']['renderPreProcess'][Ribbon::class] = Ribbon::class . '->setRibbonForBackend';
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['configArrayPostProc'][Ribbon::class] = Ribbon::class . '->setRibbonForFrontend';
})();
