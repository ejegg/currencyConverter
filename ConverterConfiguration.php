<?php
class ConverterConfiguration {
	/*
	 * ISO 4217 code of default output currency to use when none given
	 */
	public $default_output_currency;
	/*
	 * Maximum age (in seconds) of currency rates to consider valid
	 * TODO: allow different maximum ages by currency to account for volatility
	 */
	public $max_age;
	/*
	 * Parsed out of this resource: http://www.currency-iso.org/dam/downloads/table_a1.xml
	 * Has an entry for each currency that doesn't get 2 digits after the decimal point.
	 */
	public $digits = array (
		'BIF' => 0,
		'XAF' => 0,
		'CLF' => 4,
		'CLP' => 0,
		'KMF' => 0,
		'DJF' => 0,
		'XPF' => 0,
		'GNF' => 0,
		'ISK' => 0,
		'XDR' => 0,
		'IQD' => 3,
		'JPY' => 0,
		'LYD' => 3,
		'XUA' => 0,
		'OMR' => 3,
		'PYG' => 0,
		'RWF' => 0,
		'XSU' => 0,
		'TND' => 3,
		'UGX' => 0,
		'UYI' => 0,
		'VUV' => 0,
		'VND' => 0,
		'XBA' => 0,
		'XBB' => 0,
		'XBC' => 0,
		'XBD' => 0,
		'XTS' => 0,
		'XXX' => 0,
		'XAU' => 0,
		'XPD' => 0,
		'XPT' => 0,
		'XAG' => 0
	);	
}