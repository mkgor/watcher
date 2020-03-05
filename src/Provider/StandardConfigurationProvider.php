<?php

namespace Watcher\Provider;

/**
 * Class StandardConfigurationProvider
 * @package Watcher\Provider
 */
class StandardConfigurationProvider implements ConfigurationProviderInterface
{
    /**
     * @var mixed
     */
    public $config;

    /**
     * StandardConfigurationProvider constructor.
     * @param $configPath
     */
    public function __construct($configPath)
    {
        $this->config = include($configPath);
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param  mixed  $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }
}