<?php

namespace WapplerSystems\ContextRibbon\Hooks;

use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use WapplerSystems\ContextRibbon\Helper\ContextHelper;

/**
 * Class Frontend
 *
 * @package WapplerSystems\ContextRibbon\Hooks
 * @author Sven Wappler
 * @author  Ioulia Kondratovitch <ik@plan2.net>
 */
class Frontend
{

    /**
     *
     * @param array $params
     * @param TypoScriptFrontendController $pObj
     */
    public function frontendHook($params, $pObj)
    {
        if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['context_ribbon'])) {
            $configuration = (array)unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['context_ribbon']);

            if (isset($configuration['enableFrontend']) && (bool)$configuration['enableFrontend']) {
                ContextHelper::addMetaTag();
                ContextHelper::addCssJsFiles();
            }
        }
    }

}