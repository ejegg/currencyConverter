<?php
$config = new ConverterConfiguration();
$config->default_output_currency = 'USD';
$config->max_age = 129600; # 36 hours

$repo = new MySqlRateRepository("server", "username", "password", "dbname");
$source = new XmlHttpRateSource("http://toolserver.org/~kaldari/tasks/rates.xml");