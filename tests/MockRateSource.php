<?php
require 'IConversionRateSource.php';

class MockRateSource implements IConversionRateSource {
	
	public $rates = array();
	
	public function getRates() {
		return rates;
	}
}