<?php

namespace WapplerSystems\ContextRibbon\Helper;

use TYPO3\CMS\Core\Core\ApplicationContext;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class ContextHelper
 *
 * @package WapplerSystems\ContextRibbon\Helper
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
        } elseif ($context->isProduction()) {
            $strContext = 'production';
        }

        $pageRenderer->addHeaderData('<meta name="context" value="' . $strContext . '" />');
    }

}