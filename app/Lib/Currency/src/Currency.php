<?php

namespace Currency;

use Currency\Models\Currency as Model;

class Currency
{
    private $base = null;
    private $foreign = null;

    public $id = null;
    public $name = null;
    public $symbol = null;
    public $location = null;
    public $amount = 0;

    public function __construct(string $currency, $amount = 0)
    {
        CurrencyApi::populateDB();
        $this->base = Model::findOrFail($currency);
        $this->id = $this->base->id;
        $this->name = $this->base->name;
        $this->symbol = $this->base->symbol;
        $this->location = $this->base->location;
        $this->amount = $amount;
    }

    public function amount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function to($currency)
    {
        $exchange = $this->base->history($currency)->first();
        return new self($currency, $this->amount * $exchange->pivot->rate);
    }

    public function __toString()
    {
        return $this->location == "left" ? $this->symbol . $this->amount : $this->amount . $this->symbol;
    }
}
