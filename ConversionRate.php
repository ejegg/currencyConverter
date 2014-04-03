<?php
/*
 * Simple object to store a currency code and a conversion rate
 */
class ConversionRate {
	/*
	 * ISO 4217 code of currency this rate is converting from
	 * @var string
	 */
	public $from_currency;
	/*
	 * ISO 4217 code of currency this rate is converting to
	 * @var string
	 */
	public $to_currency;
	/*
	 * Multiply the amount of $from_currency by this number to get the 
	 * equivalent amount of $to_currency 
	 */
	public $multiplier;
	/*
	 * UNIX timestamp indicating when this rate was considered current  
	 */
	public $timestamp;
	
	public function __construct($from_currency, $to_currency, $multiplier, $timestamp) {
		$this->from_currency = $from_currency;
		$this->to_currency = $to_currency;
		$this->multiplier = $multiplier;
		$this->timestamp = $timestamp; 
	}
}