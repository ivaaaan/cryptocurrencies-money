<?php

namespace Tests\Cryptocurrencies\Currencies;

use Money\Cryptocurrencies\Currencies\Cryptocurrencies;
use Money\Currency;
use Money\Exception\UnknownCurrencyException;
use PHPUnit\Framework\TestCase;

final class CryptocurrenciesTest extends TestCase
{
    /**
     * @dataProvider currencyCodeExamples
     * @test
     */
    public function it_has_cryptocurrencies($currency)
    {
        $currencies = new Cryptocurrencies();
        $this->assertTrue($currencies->contains(new Currency($currency)));
    }

    /**
     * @dataProvider currencyCodeExamples
     * @test
     */
    public function it_provides_subunit($currency)
    {
        $currencies = new Cryptocurrencies();
        $this->assertInternalType('int', $currencies->subunitFor(new Currency($currency)));
    }

    /**
     * @test
     */
    public function it_throws_an_exception_when_providing_subunit_and_currency_is_unknown()
    {
        $this->expectException(UnknownCurrencyException::class);
        $currencies = new Cryptocurrencies();
        $currencies->subunitFor(new Currency('XXXXXX'));
    }

    /**
     * @test
     */
    public function it_is_iterable()
    {
        $currencies = new Cryptocurrencies();
        $iterator = $currencies->getIterator();
        $this->assertContainsOnlyInstancesOf(Currency::class, $iterator);
    }

    public function currencyCodeExamples()
    {
        $currencies = require __DIR__.'/../../resources/cryptocurrencies.php';
        $currencies = array_keys($currencies);

        return array_map(function ($currency) {
            return [$currency];
        }, $currencies);
    }
}
