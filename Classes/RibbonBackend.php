<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon;

use TYPO3\CMS\Backend\Controller\Event\AfterBackendPageRenderEvent;
use TYPO3\CMS\Core\Attribute\AsEventListener;

#[AsEventListener(identifier: 'context-ribbon/backend/after-backend-page-render')]
final class RibbonBackend
{
    public function __construct(
        protected Ribbon $ribbon
    ) {
    }

    public function __invoke(AfterBackendPageRenderEvent $event): void
    {
        $this->ribbon->setRibbon('backend');
    }
}
