<?php

include __DIR__ . '/vendor/autoload.php';

use Vstaran\CsvFileStore;

$cities = new CsvFileStore( 'product.csv', true);

foreach ($cities as $key => $value) {
    echo $key . " : <br><pre>";
    print_r($value);
    echo "</pre><hr>";
}

/*
Example ouput:

Array
(
    [id] => 238
    [name] => Гусятница прямокутна Simax
    [quantity] => 4
    [price] => 349
)
*/