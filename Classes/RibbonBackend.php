<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon;

use TYPO3\CMS\Backend\Controller\Event\AfterBackendPageRenderEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class RibbonBackend
{
    protected Ribbon $ribbon;

    public function __construct(
    ) {
        $this->ribbon = GeneralUtility::makeInstance(Ribbon::class);
    }

    public function __invoke(AfterBackendPageRenderEvent $event): void
    {
        $this->ribbon->setRibbon('backend');
    }
}
