<?php

namespace Money\Cryptocurrencies\Formatter;

use Money\Currencies;
use Money\Exception\FormatterException;
use Money\Money;
use Money\MoneyFormatter;
use Money\Number;

final class CryptocurrencyMoneyFormatter implements MoneyFormatter
{
    /**
     * @var int
     */
    private $fractionDigits;

    /**
     * @var Currencies
     */
    private $currencies;

    /**
     * @param int        $fractionDigits
     * @param Currencies $currencies
     */
    public function __construct($fractionDigits, Currencies $currencies)
    {
        $this->fractionDigits = $fractionDigits;
        $this->currencies = $currencies;
    }

    public function format(Money $money)
    {
        if (!$this->currencies->contains($money->getCurrency())) {
            throw new FormatterException(sprintf('CryptocurrencyFormatter does not support "%s".', $money->getCurrency()->getCode()));
        }

        $valueBase = $money->getAmount();
        $negative = false;

        if ('-' === $valueBase[0]) {
            $negative = true;
            $valueBase = substr($valueBase, 1);
        }

        $subunit = $this->currencies->subunitFor($money->getCurrency());
        $valueBase = Number::roundMoneyValue($valueBase, $this->fractionDigits, $subunit);
        $valueLength = strlen($valueBase);

        if ($valueLength > $subunit) {
            $formatted = substr($valueBase, 0, $valueLength - $subunit);

            if ($subunit) {
                $formatted .= '.';
                $formatted .= substr($valueBase, $valueLength - $subunit);
            }
        } else {
            $formatted = '0.'.str_pad('', $subunit - $valueLength, '0').$valueBase;
        }

        if ($this->fractionDigits === 0) {
            $formatted = substr($formatted, 0, strpos($formatted, '.'));
        } elseif ($this->fractionDigits > $subunit) {
            $formatted .= str_pad('', $this->fractionDigits - $subunit, '0');
        } elseif ($this->fractionDigits < $subunit) {
            $lastDigit = strpos($formatted, '.') + $this->fractionDigits + 1;
            $formatted = substr($formatted, 0, $lastDigit);
        }

        $formatted = sprintf('%s %s', $formatted, $money->getCurrency()->getCode());

        if (true === $negative) {
            $formatted = '-'.$formatted;
        }

        return $formatted;
    }
}
