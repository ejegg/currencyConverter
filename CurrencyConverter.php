<?php
require_once 'ConversionRate.php';
require_once 'ConverterConfiguration.php';
require_once 'IConversionRateRepository.php';
require_once 'IConversionRateSource.php';
require_once 'ICurrencyConverter.php';
/**
 * Currency conversion utility class
 */
class CurrencyConverter implements ICurrencyConverter {
	
	protected $rateSource;
	protected $rateRepo;
	protected $configuration;
	
	public function __construct(ConverterConfiguration $config, IConversionRateSource $source, IConversionRateRepository $repo) {
		$this->configuration = $config;
		$this->rateSource = $source;
		$this->rateRepo = $repo;
	}
	
	public function updateRates() {
		
	}
	
	public function convert($amount, $to_currency = false) {
		
	}
		
	public function convertBatch($amounts, $to_currency = false) {
		$conv = function($amount) {
			return $this->convert($amount, $to_currency);
		};
		return array_map($conv, $amounts);
	}
}