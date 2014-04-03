<?php
class MySqlRateRepository implements IConversionRateRepository {

	protected $server;
	protected $user;
	protected $password;
	protected $dbName;
	const TABLE = 'CurrencyRates';
	
	public function __construct($server, $user, $password, $dbName) {
		$this->server = $server;
		$this->user = $user;
		$this->password = $password;
		$this->dbName = $dbName;
	}
	
	public function storeRates(array $rates) {
		
	}
	
	public function getRate($from_currency, $to_currency, $newer_than = false) {
		return false;
	}
}