<?php
/* 
 * Interface for an object that can retrieve and store conversion rates, 
 * then use them to convert currency amounts to a default    
 */
interface ICurrencyConverter {
	/*
	 * Instructs the currency converter to get the latest rates from its source and store them
	 */
	public function updateRates();
	/*
	 * @param string $amount the ISO 4217 currency code of the input currency, a single space, and the number of units of that currency    
	 * @param string $to_currency the ISO 4217 currency code of the output currency (optional)
	 * @return string|bool false if valid rate not found, otherwise the ISO 4217 currency code of the output currency, a single space, and the number of units of that currency
	 */
	public function convert($amount, $to_currency = false);
	
	/*
	 * @param array $amounts an array of strings containing the ISO 4217 currency code of the input currency, a single space, and the number of units of that currency
	 * @param string $to_currency the ISO 4217 currency code of the output currency (optional)
	 * @return array an array where each element positionally corresponds to an element in $amounts: false if valid rate not found, otherwise the ISO 4217 currency code of the output currency, a single space, and the number of units of that currency
	 */
	public function convertBatch($amounts, $to_currency = false);
}