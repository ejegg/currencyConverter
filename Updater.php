<?php
require 'CurrencyConverter.php';
require 'MySqlRateRepository.php';
require 'XmlHttpRateSource.php';
require 'Settings.php';

$converter = new CurrencyConverter($config, $source, $repo);
$converter->updateRates();

