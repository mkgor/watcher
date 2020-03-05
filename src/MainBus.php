<?php

namespace Watcher;

use Watcher\Entity\FileData;
use Watcher\Provider\ConfigurationProviderInterface;

/**
 * Class MainBus
 * @package Watcher
 */
class MainBus
{
    /**
     * @var ConfigurationProviderInterface
     */
    private $configurationProvider;

    /**
     * @var bool
     */
    private $disableFlag = false;

    /**
     * @var array
     */
    private $fileHashes = [];

    /**
     * @var int
     */
    private $rate = 200;

    /**
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param  int  $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return bool
     */
    public function isDisableFlag()
    {
        return $this->disableFlag;
    }

    /**
     * @param  bool  $disableFlag
     */
    public function setDisableFlag($disableFlag)
    {
        $this->disableFlag = $disableFlag;
    }

    /**
     * @return mixed
     */
    public function getConfigurationProvider()
    {
        return $this->configurationProvider;
    }

    /**
     * @param  mixed  $configurationProvider
     */
    public function setConfigurationProvider($configurationProvider)
    {
        $this->configurationProvider = $configurationProvider;
    }

    /**
     * MainBus constructor.
     * @param  ConfigurationProviderInterface  $configurationProvider
     */
    public function __construct(ConfigurationProviderInterface $configurationProvider)
    {
        $this->setConfigurationProvider($configurationProvider);
    }

    /**
     * @throws \Exception
     */
    public function watch()
    {
        $this->initializeFileHashes();

        while(!$this->isDisableFlag()) {
            foreach($this->configurationProvider->getConfig() as $name => $watchable)
            {
                if(!file_exists($watchable['file'])) {
                    $watchable['onDelete']($this, new FileData($this->fileHashes[$name]['hash'], null, $this->fileHashes[$name]['content'], null, []));
                } else {
                    $hash = hash_file('crc32', $watchable['file']);

                    if ($hash != $this->fileHashes[$name]['hash']) {
                        echo sprintf("- \x1b[33mCatched editing of \x1b[1;42;30m`%s`\x1b[0m", realpath($watchable['file'])) . PHP_EOL;
                        $watchable['onEdit']($this, new FileData($this->fileHashes[$name]['hash'], $hash, $this->fileHashes[$name]['content'], file_get_contents($watchable['file']), []));

                        $this->fileHashes[$name]['hash'] = $hash;
                    }
                }
            }

            sleep($this->getRate()/1000);
        }

        echo "- \e[33mExiting application...";
    }

    /**
     * @throws \Exception
     */
    public function initializeFileHashes()
    {
        foreach($this->configurationProvider->getConfig() as $name => $watchable)
        {
            if(file_exists($watchable['file'])) {
                $this->fileHashes[$name]['hash'] = hash_file('crc32', $watchable['file']);
                $this->fileHashes[$name]['content'] = file_get_contents($watchable['file']);

                echo sprintf("- %s \x1b[32mStarting watching \x1b[1;42;30m`%s`\x1b[0m", $this->fileHashes[$name]['hash'], realpath($watchable['file'])) . PHP_EOL;
            } else {
                throw new \Exception('File %s not exists', $watchable['file']);
            }
        }
    }
}