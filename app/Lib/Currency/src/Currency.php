<?php

namespace Currency;

use Currency\Models\Currency as Model;

class Currency
{
    private $base = null;
    private $foreign = null;
    private $_amount = 0;

    public $id = null;
    public $name = null;
    public $symbol = null;
    public $location = null;

    public function __construct(string $currency, $amount = 0)
    {
        CurrencyApi::populateDB();
        $this->base = Model::findOrFail($currency);
        $this->id = $this->base->id;
        $this->name = $this->base->name;
        $this->symbol = $this->base->symbol;
        $this->location = $this->base->location;
        $this->_amount = $amount;
    }

    public function getAmount()
    {
        return number_format($this->_amount, 2);
    }

    public function setAmount($value)
    {
        $this->_amount = $value;
        return $this;
    }

    public function to($currency)
    {
        $exchange = $this->base->history($currency)->first();
        return new self($currency, $this->_amount * $exchange->pivot->rate);
    }

    public function __toString()
    {
        return $this->location == "left" ? $this->symbol . $this->getAmount() : $this->getAmount() . $this->symbol;
    }
}
