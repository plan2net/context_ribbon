<?php

namespace WapplerSystems\ContextRibbon\Helper;

use TYPO3\CMS\Core\Core\ApplicationContext;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * Class ContextHelper
 *
 * @package WapplerSystems\ContextRibbon\Helper
 * @author Sven Wappler
 * @author  Ioulia Kondratovitch <ik@plan2.net>
 */
class ContextHelper
{
    /**
     * Provide HTML with an information about TYPO3_CONTEXT:
     * add a meta tag to the header data.
     */
    public static function addMetaTag()
    {

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Page\\PageRenderer');

        $strContext = '';
        /** @var ApplicationContext $context */
        $context = GeneralUtility::getApplicationContext();

        if (isset($context) && ($context->__toString() === 'Production/Staging' || $context->__toString() === 'Development/Staging')) {
            $strContext = 'staging';
        } elseif ($context->isDevelopment()) {
            $strContext = 'development';
        } elseif ($context->isTesting()) {
            $strContext = 'testing';
        } elseif ($context->isProduction() && TYPO3_MODE === 'BE') {
            $strContext = 'production';
        }

        $pageRenderer->addHeaderData('<meta name="context" value="' . $strContext . '" />');
    }

    /**
     * Add CSS and JS files
     */
    public static function addCssJsFiles()
    {
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Page\\PageRenderer');

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
    }

}