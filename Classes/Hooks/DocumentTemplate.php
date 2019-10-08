<?php

namespace WapplerSystems\ContextRibbon\Hooks;

use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use WapplerSystems\ContextRibbon\Helper\ContextHelper;

/**
 * Class DocumentTemplate
 *
 * @package WapplerSystems\ContextRibbon\Hooks
 * @author Sven Wappler
 * @author  Ioulia Kondratovitch <ik@plan2.net>
 */
class DocumentTemplate
{

    /**
     *
     * @param array $hookParameters
     * @param \TYPO3\CMS\Backend\Template\DocumentTemplate $documentTemplateInstance
     */
    public function preHeaderRenderHook($hookParameters, $documentTemplateInstance)
    {
        if ((VersionNumberUtility::convertVersionNumberToInteger(TYPO3_branch) < VersionNumberUtility::convertVersionNumberToInteger('7.6')) && $documentTemplateInstance->bodyTagId !== "typo3-backend-php") {
            return;
        }

        if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['context_ribbon'])) {
            $configuration = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['context_ribbon'],
                [false]);

            if (isset($configuration['enableBackend']) && (bool)$configuration['enableBackend']) {
                ContextHelper::addMetaTag();
                ContextHelper::addCssJsFiles();
            }
        }
    }

}