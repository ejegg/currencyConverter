<?php
class XmlHttpRateSource implements IConversionRateSource {
	protected $url;
	public function __construct($source_url) {
		$this->url = $source_url;
	}
	
	public function getRates() {
		$request = new HttpRequest($this->url, HttpRequest::METH_GET);
	    $request->send();
	    if ($request->getResponseCode() == 200) {
	        return parse($request->getResponseBody());
	    }
		return array();
	}
	
	protected function parse($response) {
		$xml = new SimpleXMLElement($response);
		return array_map($this->parseNode, $xml->conversion);
	}
	
	protected function parseNode($conversion) {
		return new ConversionRate($conversion->currency, "USD", floatval($conversion->rate), time());
	}
}