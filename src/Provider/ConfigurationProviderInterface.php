<?php

namespace Watcher\Provider;

/**
 * Interface ConfigurationProviderInterface
 * @package Watcher\Provider
 */
interface ConfigurationProviderInterface
{
    /**
     * ConfigurationProviderInterface constructor.
     * @param $configPath
     */
    public function __construct($configPath);

    /**
     * @return array
     */
    public function getConfig();

    /**
     * @param $config
     * @return mixed
     */
    public function setConfig($config);
}