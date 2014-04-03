<?php
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
	
	
}