<?php

declare(strict_types=1);

namespace idiosyncratic\DevTools;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event;
use Composer\Script\ScriptEvents;
use DirectoryIterator;
use function copy;
use function dirname;
use function file_exists;
use function getcwd;
use function sprintf;

final class ComposerPlugin implements PluginInterface, EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public function activate(Composer $composer, IOInterface $io) : void
    {
        // nothing to activate
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents() : array
    {
        return [
            ScriptEvents::POST_INSTALL_CMD => 'setupDevTools',
            ScriptEvents::POST_UPDATE_CMD => 'setupDevTools',
        ];
    }

    public static function setupDevTools(Event $composerEvent) : void
    {
        $projectRoot = getcwd();

        $configFiles = new DirectoryIterator(sprintf('%s/files', dirname(dirname(__FILE__))));

        $composerEvent->getIO()->write(
            '<info>idiosyncratic/devtools:</info> Setting up devtools'
        );

        foreach ($configFiles as $file) {
            if ($file->isDot() !== false || $file->isFile() !== true) {
                continue;
            }

            $destFile = sprintf('%s/%s', $projectRoot, $file->getFilename());

            if (file_exists($destFile) !== false) {
                $composerEvent->getIO()->write(sprintf(
                    '<info>idiosyncratic/devtools:</info> File %s already exists, skipping',
                    $destFile
                ));

                continue;
            }

            copy($file->getPathname(), $destFile);

            $composerEvent->getIO()->write(sprintf(
                '<info>idiosyncratic/devtools:</info> Copying %s to %s',
                $file->getPathname(),
                $destFile
            ));
        }
    }
}
