<?php
declare(strict_types=1);

namespace WapplerSystems\ContextRibbon\Hooks;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use WapplerSystems\ContextRibbon\Helper\ContextHelper;

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
            $configurationEntry = (bool)GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('context_ribbon',
                $path);
        } catch (ExtensionConfigurationExtensionNotConfiguredException $extensionConfigurationExtensionNotConfiguredException) {
            $this->logger->error($extensionConfigurationExtensionNotConfiguredException->getMessage());
        } catch (ExtensionConfigurationPathDoesNotExistException $extensionConfigurationPathDoesNotExistException) {
            $this->logger->error($extensionConfigurationPathDoesNotExistException->getMessage());
        }
        if ($configurationEntry) {
            ContextHelper::addMetaTag();
            ContextHelper::addCssJsFiles();
        }
    }

}