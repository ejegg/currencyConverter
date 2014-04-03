Code sample for Wikimedia Foundation.

Class to convert amounts of money between different currencies, and to maintain a local store of exchange rates provided by a third party.

Rounds to correct number of decimal places for output currency.

Given one conversion rate between currencies, can convert both ways.  Not implemented, but might be fun: finding a conversion path between two currencies when no explicit rate is given.

Not yet implemented: limiting age of acceptable rates, batching db queries for array conversion.

There's a small set of PHPUnit tests available in the tests folder.

You can set source URL and database connection info in Settings.php, as well as a default output currency.

CurrencyConverter.php contains the main class.  It takes an instance of IConversionRateRepository for local storage, an instance of IConversionRateSource to provide updated rates, and a ConverterConfiguration for the default output currency, number of decimal digits for each currency, and (not yet used) max allowable rate age.  Its convert function throws an exception if given incorrectly formatted input, and returns false if the converter can't find the rate to fulfil the request.  In Real Life (TM) this class would also take an instance of some ILogger interface and log at least update failures, and probably lookup failures as well.

MySqlRateRepository implements IConversionRateRepository.  It could be written as a generic DatabaseRateRepository and just take a PDO object in the constructor, but we'd want subclasses to override the multi-insert syntax for different DBs.

XmlHttpRateSource implements IConversionRateSource in the simplest way possible - file_get_contents for the retrieval, and SimpleXMLElement to parse.  More robust error handling might call for HttpRequest and XmlReader.

Updater.php is meant to be called from cron - it instantiates CurrencyConverter.php and runs the rate update.
