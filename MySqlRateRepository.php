<?php
class MySqlRateRepository implements IConversionRateRepository {

	protected $db;
	const TABLE = "CurrencyRates";
	 
	public function __construct($server, $user, $password, $dbName) {
		$this->db = new PDO( "mysql:host=" . $server . ";dbname=" . $dbName , $user, $password);
	}
	
	public function storeRates(array $rates) {
		$numRates = count($rates);
		echo $numRates;
		$insert = "INSERT INTO " . self::TABLE . " (FromCurrency, ToCurrency, Multiplier, ValidTime) VALUES";
		#Multi-insert!
		$values = array_fill(0, $numRates, " (?, ?, ?, ?)");
		$command = $this->db->prepare($insert . implode(",", $values));
		$i = 0;
		date_default_timezone_set("UTC"); #global?
		for (;$i < $numRates; $i++) {
			$paramIdx = 4 * $i;
			$rate = $rates[$i];
			$command->bindValue($paramIdx + 1, $rate->from_currency);
			$command->bindValue($paramIdx + 2, $rate->to_currency);
			$command->bindValue($paramIdx + 3, $rate->multiplier);
			$command->bindValue($paramIdx + 4, date("Y-m-d H:i:s", $rate->timestamp));
		}
		$command->execute();
	}
	
	public function getRate($from_currency, $to_currency, $newer_than = false) {
		$query = "SELECT FromCurrency, ToCurrency, Multiplier, ValidTime " .
			"FROM " . self::TABLE . " " .
			"WHERE ( FromCurrency = :from AND ToCurrency = :to ) " .
			"OR ( FromCurrency = :to AND ToCurrency = :from ) " .
			"ORDER BY ValidTime DESC " .
			"LIMIT 1";
	}
	
}