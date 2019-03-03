<?php

namespace Money\Cryptocurrencies\Currencies;

use Money\Currencies;
use Money\Currency;
use Money\Exception\UnknownCurrencyException;

final class Cryptocurrencies implements Currencies
{
    /**
     * @var array
     */
    private static $currencies;

    /**
     * {@inheritdoc}
     */
    public function contains(Currency $currency)
    {
        return array_key_exists($currency->getCode(), $this->getCurrencies());
    }

    /**
     * {@inheritdoc}
     */
    public function subunitFor(Currency $currency)
    {
        if (!$this->contains($currency)) {
            throw new UnknownCurrencyException(sprintf('Cannot find cryptocurrency "%s"', $currency->getCode()));
        }

        return $this->getCurrencies()[$currency->getCode()]['subunit'];
    }

    public function getIterator()
    {
        return array_map(function ($currencyCode) {
            return new Currency($currencyCode);
        }, array_keys($this->getCurrencies()));
    }

    private function getCurrencies()
    {
        if (null === self::$currencies) {
            self::$currencies = $this->loadCurrencies();
        }

        return self::$currencies;
    }

    private function loadCurrencies()
    {
        $file = __DIR__.'/../../resources/cryptocurrencies.php';
        if (file_exists($file)) {
            return require $file;
        }
        throw new \RuntimeException('Failed to load currency cryptocurrencies.');
    }
}
