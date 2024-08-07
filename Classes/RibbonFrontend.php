<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class RibbonFrontend
{
    protected Ribbon $ribbon;

    public function __construct()
    {
        $this->ribbon = GeneralUtility::makeInstance(Ribbon::class);
    }

    public function setRibbonForFrontend(): void
    {
        $this->ribbon->setRibbon('frontend');
    }
}
