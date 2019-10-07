<?php
namespace WapplerSystems\ContextRibbon\Hooks;

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use WapplerSystems\ContextRibbon\Helper\ContextHelper;

class DocumentTemplate {

	/**
	 *
	 * @param array $hookParameters
	 * @param \TYPO3\CMS\Backend\Template\DocumentTemplate $documentTemplateInstance
	 */
	public function preHeaderRenderHook($hookParameters, $documentTemplateInstance) {
	    
        if ((VersionNumberUtility::convertVersionNumberToInteger(TYPO3_branch) < VersionNumberUtility::convertVersionNumberToInteger('7.6')) && $documentTemplateInstance->bodyTagId !== "typo3-backend-php") {
            return;
        }

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = $hookParameters['pageRenderer'];

        $pageRenderer->addCssFile(
            PathUtility::getAbsoluteWebPath(
                GeneralUtility::getFileAbsFileName(
                    'EXT:context_ribbon/Resources/Public/CSS/ribbon.css'
                )
            )
        );

        $pageRenderer->addJsFile(
            PathUtility::getAbsoluteWebPath(
                GeneralUtility::getFileAbsFileName(
                    'EXT:context_ribbon/Resources/Public/JavaScript/ribbon.js'
                )
            )
        );

        ContextHelper::addMetaTag();
	}

}