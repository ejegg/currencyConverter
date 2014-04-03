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
}