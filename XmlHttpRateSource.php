<?php
class XmlHttpRateSource implements IConversionRateSource {
	protected $url;
	public function __construct($source_url) {
		$this->url = $source_url;
	}
	
	public function getRates() {
		return array();
	}
}