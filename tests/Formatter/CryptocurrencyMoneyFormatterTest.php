<?php

namespace Tests\Cryptocurrencies\Formatter;

use Money\Cryptocurrencies\Formatter\CryptocurrencyMoneyFormatter;
use Money\Currencies;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;

final class CryptocurrencyMoneyFormatterTest extends TestCase
{
    /**
     * @dataProvider bitcoinExamples
     * @test
     */
    public function it_formats_money($value, $formatted, $fractionDigits)
    {
        $currencies = $this->createMock(Currencies::class);
        $formatter = new CryptocurrencyMoneyFormatter($fractionDigits, $currencies);

        $currency = new Currency('BTC');
        $currencies->expects($this->once())->method('subunitFor')->with($currency)->willReturn(8);
        $currencies->expects($this->once())->method('contains')->with($currency)->willReturn(true);

        $money = new Money($value, $currency);

        $this->assertSame($formatted, $formatter->format($money));
    }

    public function bitcoinExamples()
    {
        return [
            [100000000000, '1000.00 BTC', 2],
            [1000000000000, '10000.00 BTC', 2],
            [41000000, '0.41 BTC', 2],
            [5000000, '0.05 BTC', 2],
            [500000000, '5 BTC', 0],
            [50000, '0.0005 BTC', 4],
            [100000500000, '1000.01 BTC', 2],
            [100099500000, '1001.00 BTC', 2],
            [999999600000, '10000.00 BTC', 2],
            [100, '0.00 BTC', 2],
        ];
    }
}
