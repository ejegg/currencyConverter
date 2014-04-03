CREATE TABLE IF NOT EXISTS CurrencyRates (
	RateID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	FromCurrency CHAR(3),
        ToCurrency CHAR(3),
        Multiplier Decimal(10,6),
        ValidTime DateTime
)

