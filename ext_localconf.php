<?php

use WapplerSystems\ContextRibbon\RibbonFrontend;

defined('TYPO3') or exit('Access denied.');

(static function () {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['configArrayPostProc'][RibbonFrontend::class] = RibbonFrontend::class . '->setRibbonForFrontend';
})();
