<?php

require_once "vendor/autoload.php";

$currentConfigurationProvider = \Watcher\Provider\StandardConfigurationProvider::class;
$configPath = __DIR__ . '/watch.php';


$bus = new \Watcher\MainBus(new $currentConfigurationProvider($configPath));

$bus->watch();