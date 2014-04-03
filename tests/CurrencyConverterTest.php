<?php
require_once "PHPUnit/Autoload.php";
require "MockRateRepository.php";
require "MockRateSource.php";
require "CurrencyConverter.php";

class CurrencyConverterTest extends PHPUnit_Framework_TestCase {
	
	public static function main() { //allow self-execution
		$tests = new PHPUnit_Framework_TestSuite(__CLASS__);
		PHPUnit_TextUI_TestRunner::run($tests);
	} 
	
	protected $rates;
	
	protected function setUp() {
		$this->rates = array(
			new ConversionRate("JPY", "USD", 0.013125, time() - 10000),
			new ConversionRate("BGN", "USD", 0.6707, time() - 20000),
			new ConversionRate("CZK", "USD", 0.05190, time() - 50000),
			new ConversionRate("ARS", "USD", 0.2294, time() - 100000),
		);
	}
	
	/*
	 * Does it stash what it's given?
	 */
	public function testUpdateRates() {

		$config = new ConverterConfiguration();
		$source = new MockRateSource();
		$source->rates = $this->rates;
		$repo = new MockRateRepository();
		
		$converter = new CurrencyConverter($config, $source, $repo);
		
		$converter->updateRates();
		
		foreach ($this->rates as $rate) {
			$this->assertTrue(array_key_exists($rate->from_currency, $repo->rateDict));
			$storedRate = $repo->rateDict[$rate->from_currency];
			$this->assertEquals($rate->multiplier, $storedRate->multiplier);
			$this->assertEquals($rate->timestamp, $storedRate->timestamp);
		}
	}
	
	public function testConvertRounding() {
		$config = new ConverterConfiguration();
		$config->default_output_currency = "USD";
		$config->definitionsPath = "/home/elliott/src/php/CurrencyConverter/CurrencyDefinitions.xml";
		$source = new MockRateSource();
		$repo = new MockRateRepository();
		$repo->storeRates($this->rates);
		
		$converter = new CurrencyConverter($config, $source, $repo);
		
		$result = $converter->convert("JPY 5000");
		$this->assertEquals("USD 65.63", $result);
	}
	
	public function testConvertInvertsRates() {
		$config = new ConverterConfiguration();
		$config->default_output_currency = "USD";
		$source = new MockRateSource();
		$repo = new MockRateRepository();
		$repo->storeRates($this->rates);
		
		$converter = new CurrencyConverter($config, $source, $repo);
		
		$result = $converter->convert("USD 65.625", "JPY");
		$this->assertEquals("JPY 5000", $result);
	}
}

if (!defined('PHPUnit_MAIN_METHOD')) {
	CurrencyConverterTest::main();
}