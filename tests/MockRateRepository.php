<?php
require 'IConversionRateRepository.php';

class MockRateRepository implements IConversionRateRepository {
	
	public $rateDict = array();
	
	public function storeRates(array $rates) {
		foreach ($rates as $rate) {
			$this->rateDict[$rate->from_currency] = $rate;
		}
	}
	
	public function getRate($from_currency, $to_currency, $newer_than = false) {
		if (!array_key_exists($from_currency, $this->rateDict)) {
			return false;
		}
		
		return $this->rateDict[$from_currency];
	}
}