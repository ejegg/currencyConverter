<?php
require_once "ConversionRate.php";
require_once "ConverterConfiguration.php";
require_once "IConversionRateRepository.php";
require_once "IConversionRateSource.php";
require_once "ICurrencyConverter.php";
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
		$rates = $this->rateSource->getRates();
		$this->rateRepo->storeRates($rates);
	}
	
	public function convert($amount, $to_currency = false) {
		if (!preg_match("/^[a-zA-Z]{3} -?\d+(\.\d+)?$/", $amount)) {
			throw new Exception("Input '" . $amount . "' is not valid.  Input must consist of a three letter currency code, a space, and a number");
		}
		$from_currency = substr($amount, 0, 3);
		$from_amount = floatval(substr($amount, 4));
		
		if (!$to_currency) {
			$to_currency = $this->configuration->default_output_currency;
		}
		
		$rate = $this->rateRepo->getRate($from_currency, $to_currency);
		$multiplier = $rate->multiplier;
		
		if ($rate->from_currency == $to_currency) {
			if ($multiplier == 0) {
				return false;
			}
			$multiplier = 1 / $multiplier;
		}
		$precision = 2;
		if (array_key_exists($to_currency, $this->configuration->digits)) {
			$precision = $this->configuration->digits[$to_currency];
		}
		$to_amount = round($from_amount * $multiplier, $precision);
		return sprintf("%s %01." . $precision . "f", $to_currency, $to_amount);
	}
		
	public function convertBatch($amounts, $to_currency = false) {
		$conv = function($amount) {
			return $this->convert($amount, $to_currency);
		};
		return array_map($conv, $amounts);
	}
}