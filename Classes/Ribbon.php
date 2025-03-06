<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon;

use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Http\ApplicationType;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * Class Ribbon
 *
 * @author Sven Wappler
 * @author Ioulia Kondratovitch <ik@plan2.net>
 */
class Ribbon
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly PageRenderer $pageRenderer
    ) {
    }

    public function setRibbon(string $mode): void
    {
        $contextName = $this->getContextName();

        if ($this->enabledFor($mode) && null !== $contextName) {
            $this->addMetaTag($contextName);
            $this->addCssJsFiles();
        }
    }

    /**
     * Provide HTML with an information about TYPO3_CONTEXT:
     * add a meta tag to the header data.
     */
    protected function addMetaTag(string $contextName): void
    {
        $this->pageRenderer->addHeaderData('<meta name="context" content="' . $contextName . '" />');
    }

    protected function addCssJsFiles(): void
    {
        $this->pageRenderer->addCssFile(
            PathUtility::getAbsoluteWebPath(
                GeneralUtility::getFileAbsFileName(
                    'EXT:context_ribbon/Resources/Public/CSS/ribbon.css'
                )
            )
        );

        $this->pageRenderer->addJsFile(
            PathUtility::getAbsoluteWebPath(
                GeneralUtility::getFileAbsFileName(
                    'EXT:context_ribbon/Resources/Public/JavaScript/ribbon.js'
                )
            )
        );
    }

    protected function enabledFor(string $mode): bool
    {
        $enabled = false;
        try {
            $enabled = (bool) GeneralUtility::makeInstance(ExtensionConfiguration::class)
                ->get('context_ribbon', 'enable' . ucfirst($mode));
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
        }

        return $enabled;
    }

    protected function getContextName(): ?string
    {
        $contextName = null;
        $context = Environment::getContext();
        $applicationType = null;
        if (($GLOBALS['TYPO3_REQUEST'] ?? null) instanceof ServerRequestInterface) {
            $applicationType = ApplicationType::fromRequest($GLOBALS['TYPO3_REQUEST']);
        }

        if ('Production/Staging' === (string) $context || 'Development/Staging' === (string) $context) {
            $contextName = 'staging';
        } elseif ($context->isDevelopment()) {
            $contextName = 'development';
        } elseif ($context->isTesting()) {
            $contextName = 'testing';
        } elseif ((null !== $applicationType && $applicationType->isBackend()) && $context->isProduction()) {
            $contextName = 'production';
        }

        return $contextName;
    }
}
