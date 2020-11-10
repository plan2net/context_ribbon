<?php

declare(strict_types=1);

namespace WapplerSystems\ContextRibbon\Hooks;

use Exception;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Core\ApplicationContext;
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
        $this->processExtensionConfiguration('enableBackend');
    }

    public function setRibbonForFrontend(): void
    {
        $this->processExtensionConfiguration('enableFrontend');
    }

    protected function processExtensionConfiguration(string $path): void
    {
        try {
            $configurationEntry = (bool)GeneralUtility::makeInstance(ExtensionConfiguration::class)
                ->get('context_ribbon', $path);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
        if ($configurationEntry) {
            $this->addMetaTag();
            $this->addCssJsFiles();
        }
    }

    /**
     * Provide HTML with an information about TYPO3_CONTEXT:
     * add a meta tag to the header data.
     */
    protected function addMetaTag(): void
    {
        $strContext = '';
        /** @var ApplicationContext $context */
        $context = Environment::getContext();

        if (isset($context) && ($context->__toString() === 'Production/Staging' || $context->__toString() === 'Development/Staging')) {
            $strContext = 'staging';
        } elseif ($context->isDevelopment()) {
            $strContext = 'development';
        } elseif ($context->isTesting()) {
            $strContext = 'testing';
        } elseif (TYPO3_MODE === 'BE' && $context->isProduction()) {
            $strContext = 'production';
        }

        $this->pageRenderer->addHeaderData('<meta name="context" content="' . $strContext . '" />');
    }

    /**
     * Add CSS and JS files
     */
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
}