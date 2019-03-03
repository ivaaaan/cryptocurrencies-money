# Cryptocurrencies for [moneyphp](https://github.com/moneyphp/money)

This library provides list of cryptocurrencies and `CryptocurrencyFormatter`.

Currently library supports only `BTC`, `LTC` and `ETH`(I have not found a good source of cryptocurrencies list yet). If you need more feel free to create an issue or PR.

## Install

Via Composer

```bash
$ composer require iillexial/cryptocurrencies-money
```

## TODO

- [ ] Find a good resource of cryptocurrencies that also provides subunits.

- [ ] Create a `CryptocurrencyMoneyParser`

## Testing

Run unit tests via:

```bash
$ composer test
```

## Usage

The `Money\Cryptocurrencies\Currencies\Cryptocurrenices` implements the `Money\Currencies` interface, so you can use it as described in the original repository:

```php

use Money\Cryptocurrencies\Currencies\Cryptocurrencies;
use Money\Currencies\AggregateCurrencies;
use Money\Currencies\ISOCurrencies;
Money\Cryptocurrencies\Formatter\CryptocurrencyMoneyFormatter;

$currencies = new Cryptocurrencies();

// or

$currencies = new AggregatedCurrencies([
    new Cryptocurrencies(), new ISOCurrencies()
]);

$cryptocurrencyFormatter = new CryptocurrencyMoneyFormatter(2);
echo $cryptocurrencyFormatter->format(new Money(1 * 10**8, new Currency('BTC'))); // 1 BTC
```


## License

The MIT. Please see [License File](LICENSE) for more information.
