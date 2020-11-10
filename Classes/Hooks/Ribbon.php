<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon\Hooks;

use Exception;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\Environment;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;

/**
 * Class Ribbon
 *
 * @package WapplerSystems\ContextRibbon\Hooks
 * @author Sven Wappler
 * @author Ioulia Kondratovitch <ik@plan2.net>
 */
class Ribbon implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var PageRenderer
     */
    protected $pageRenderer;

    public function __construct()
    {
        $this->pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
    }

    public function setRibbonForBackend(): void
    {
        $this->setRibbon('backend');
    }

    public function setRibbonForFrontend(): void
    {
        $this->setRibbon('frontend');
    }

    protected function setRibbon($mode): void
    {
        if ($this->enabledFor($mode) && null !== ($contextName = $this->getContextName())) {
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
            $enabled = (bool)GeneralUtility::makeInstance(ExtensionConfiguration::class)
                ->get('context_ribbon', 'enable' . ucfirst($mode));
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return $enabled;
    }

    protected function getContextName(): ?string
    {
        $contextName = null;
        $context = Environment::getContext();

        if ((string)$context === 'Production/Staging' || (string)$context === 'Development/Staging') {
            $contextName = 'staging';
        } elseif ($context->isDevelopment()) {
            $contextName = 'development';
        } elseif ($context->isTesting()) {
            $contextName = 'testing';
        } elseif (TYPO3_MODE === 'BE' && $context->isProduction()) {
            $contextName = 'production';
        }

        return $contextName;
    }
}