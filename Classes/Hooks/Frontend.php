<?php
namespace WapplerSystems\ContextRibbon\Hooks;

use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use WapplerSystems\ContextRibbon\Helper\ContextHelper;

class Frontend {

    /**
     *
     * @param array $params
     * @param TypoScriptFrontendController $pObj
     */
    public function frontendHook($params, $pObj) {
        ContextHelper::addMetaTag();
    }

}