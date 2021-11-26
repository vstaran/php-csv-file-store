## Csv File Iterator
![License](https://img.shields.io/github/license/aschmelyun/larametrics.svg?style=flat-square)

Service for work with file store implements `Iterator` interface.

## Basic usage
```php
$cities = new CsvFileStore('product.csv', true);

foreach ($cities as $key => $value) {
    echo $key;
    print_r($value);
}
```

Output:
```php
Array
(
    [id] => 238
    [name] => Гусятница прямокутна Simax
    [quantity] => 4
    [price] => 349
)
```

## License
The MIT License (MIT).
