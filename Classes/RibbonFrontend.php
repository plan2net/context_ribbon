<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Event\ModifyTypoScriptConfigEvent;

class RibbonFrontend
{
    protected Ribbon $ribbon;

    public function __construct()
    {
        $this->ribbon = GeneralUtility::makeInstance(Ribbon::class);
    }

    public function __invoke(ModifyTypoScriptConfigEvent $event): void
    {
        $this->ribbon->setRibbon('frontend');
    }
}
