<?php
/*
 * Interface for objects that can store and retrieve conversion rates
 */
interface IConversionRateRepository {
	/*
	 * @param array rates an array of ConversionRate objects to store 
	 */
	public function storeRates(array $rates);
	
	/*
	 * @param string $from_currency ISO 4217 code of currency you are converting from 
	 * @param string $to_currency ISO 4217 code of currency you are converting to
	 * @param int $newer_than earliest UNIX timestamp considered valid 
	 * @return ConversionRate
	 */
	public function getRate($from_currency, $to_currency, $newer_than = false);
}