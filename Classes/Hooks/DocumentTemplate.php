<?php
namespace WapplerSystems\ContextRibbon\Hooks;



use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

class DocumentTemplate {

	/**
	 *
	 * @param array $hookParameters
	 * @param \TYPO3\CMS\Backend\Template\DocumentTemplate $documentTemplateInstance
	 */
	public function preHeaderRenderHook($hookParameters, $documentTemplateInstance) {

        if (!\TYPO3\CMS\Core\Utility\GeneralUtility::compat_version('7.6')) {

            if ($documentTemplateInstance->bodyTagId != "typo3-backend-php") {
                return;
            }
        }

        /** @var PageRenderer $pageRenderer */
	    $pageRenderer = $hookParameters['pageRenderer'];
        $pageRenderer->addCssFile(ExtensionManagementUtility::extRelPath('context_ribbon') .'/Resources/Public/CSS/ribbon.css');
        $pageRenderer->addJsFile(ExtensionManagementUtility::extRelPath('context_ribbon') . '/Resources/Public/JavaScript/ribbon.js');

        $strContext = "";
        $context = GeneralUtility::getApplicationContext();
        $parentContext = $context->getParent();

        if ($context->isDevelopment()) $strContext = "development";
        if ($context->isTesting()) $strContext = "testing";
        if ($context->isProduction()) $strContext = "production";
        if (isset($parentContext) && ($parentContext->__toString() == "Production/Staging" || $parentContext->__toString() == "Development/Staging")) {
            $strContext = "staging";
        }

        $pageRenderer->addHeaderData('<meta name="context" value="'.$strContext.'" />');

	}

}