CREATE TABLE IF NOT EXISTS CurrencyRates (
	RateID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	FromCurrency CHAR(3),
        ToCurrency CHAR(3),
        Multiplier Decimal(26,10), --in case of hyperinflation
        ValidTime DateTime
)

