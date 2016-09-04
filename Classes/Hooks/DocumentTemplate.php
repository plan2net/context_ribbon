<?php
namespace WapplerSystems\ContextRibbon\Hooks;



use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DocumentTemplate {

	/**
	 *
	 * @param array $hookParameters
	 * @param $documentTemplateInstance
	 */
	public function preHeaderRenderHook($hookParameters, $documentTemplateInstance) {

        /** @var PageRenderer $pageRenderer */
	    $pageRenderer = $hookParameters['pageRenderer'];
        $pageRenderer->addCssFile('../typo3conf/ext/context_ribbon/Resources/Public/CSS/ribbon.css');
        $pageRenderer->addJsFile('../typo3conf/ext/context_ribbon/Resources/Public/JavaScript/ribbon.js');

        $strContext = "";
        $context = GeneralUtility::getApplicationContext();
        if ($context->isDevelopment()) $strContext = "development";
        if ($context->isTesting()) $strContext = "testing";
        if ($context->isProduction()) $strContext = "production";

        $pageRenderer->addHeaderData('<meta name="context" value="'.$strContext.'" />');

	}

}