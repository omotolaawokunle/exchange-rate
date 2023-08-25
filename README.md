# Exchange Rate Laravel Package

The Exchange Rate Laravel Package provides functionalities to work with exchange rates, including fetching rates from an API and performing currency conversions.

## Installation

You can install this package via Composer by running:

```bash
composer require omotolaawokunle/exchange-rate:dev-main
```

## Configuration

After installation, you need to publish the package's configuration file:

```bash
php artisan vendor:publish --provider "Omotolaawokunle\ExchangeRate\ExchangeRateServiceProvider" --force
```

This will publish the configuration file to your `config` directory.

## Usage

### Fetching Exchange Rates

The package provides a `Parser` class to fetch exchange rates. You can use it as follows:

```php
use Omotolaawokunle\ExchangeRate\Parser;

$parser = new Parser();
$rates = $parser->getRates();
```

### Converting Currency

To perform currency conversion, you can use the `ExchangeRate` class:

```php
use Omotolaawokunle\ExchangeRate\Facades\ExchangeRate;

$amount = 100;
$currency = 'USD';
$result = ExchangeRate::exchange($amount, $currency);
```

### API Routes

The package also includes an API route for performing currency conversion. You can access it via the `/exchange` endpoint.

## Testing

You can run the package's tests using PHPUnit:

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email omotolaawokunle@gmail.com instead of using the issue tracker.

## Credits

-   [Omotola Awokunle](https://github.com/omotolaawokunle)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
