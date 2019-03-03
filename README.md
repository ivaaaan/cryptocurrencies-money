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

## Contributing

We would love to see you helping us to make this library better and better.
Please keep in mind we do not use suffixes and prefixes in class names,
so not `CurrenciesInterface`, but `Currencies`. Other than that, Style CI will help you
using the same code style as we are using. Please provide tests when creating a PR and clear descriptions of bugs when filing issues.


## License

The GNU GENERAL PUBLIC LICENSE. Please see [License File](LICENSE) for more information.
