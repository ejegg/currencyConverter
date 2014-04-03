<?php
class XmlHttpRateSource implements IConversionRateSource {
	protected $url;
	public function __construct($source_url) {
		$this->url = $source_url;
	}
	
	public function getRates() {
		$response = file_get_contents($this->url); #This really works?
		$xml = new SimpleXMLElement($response);
		$rates = array();
		foreach ($xml->conversion as $conversion) {
			$rates[] = $this->parseNode($conversion);
		}
		return $rates;
	}
	
	protected function parseNode($conversion) {
		return new ConversionRate($conversion->currency, "USD", floatval($conversion->rate), time());
	}
}