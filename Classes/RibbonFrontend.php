<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon;

use TYPO3\CMS\Frontend\Event\ModifyTypoScriptConfigEvent;
use TYPO3\CMS\Core\Attribute\AsEventListener;

#[AsEventListener(identifier: 'context-ribbon/frontend/modify-typo-script-config-event')]
class RibbonFrontend
{
    public function __construct(
        protected Ribbon $ribbon
    ) {
    }

    public function __invoke(ModifyTypoScriptConfigEvent $event): void
    {
        $this->ribbon->setRibbon('frontend');
    }
}
