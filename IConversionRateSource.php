<?php
/*
 * Interface for read-only sources of current currency conversion rates 
 */
interface IConversionRateSource {
	/*
	 * @return array an array of ConversionRate objects
	 */
	public function getRates();
}