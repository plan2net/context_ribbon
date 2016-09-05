<?php
namespace WapplerSystems\ContextRibbon\Hooks;


use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Frontend {

    /**
     *
     * @param array $params
     * @param \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $pObj
     */
    public function frontendHook($params, $pObj) {

        $config = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['context_ribbon'];
        $config = $config ? unserialize($config) : array();

        if ($config['frontend'] == false) return;

        $pageRenderer = $pObj->getPageRenderer();


        $strContext = "production";
        $context = GeneralUtility::getApplicationContext();
        $parentContext = $context->getParent();

        if ($context->isDevelopment()) $strContext = "development";
        if ($context->isTesting()) $strContext = "testing";
        if ($context->isProduction()) $strContext = "production";
        if (isset($parentContext) && $parentContext->__toString() == "Production/Staging") {
            $strContext = "staging";
        }

        $pageRenderer->addHeaderData('<meta name="context" value="'.$strContext.'" />');

        if ($strContext != "production") {
            $pageRenderer->addCssFile(ExtensionManagementUtility::extRelPath('context_ribbon') . '/Resources/Public/CSS/ribbon.css');
            $pageRenderer->addJsFile(ExtensionManagementUtility::extRelPath('context_ribbon') . '/Resources/Public/JavaScript/ribbon.js');
        }

    }

}