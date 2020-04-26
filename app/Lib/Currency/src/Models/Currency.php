<?php

namespace Currency\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    public $incrementing = false;
    private $value = 0;

    protected $fillable = [
        'name',
        'location',
        'id',
        'rate',
        'symbol'
    ];

    public function baseCurrency()
    {
        return $this->belongsToMany(Currency::class, 'exchange_rates', 'foreign_currency', 'base_currency')->withPivot('rate')->withTimestamps();
    }

    public function foreignCurrency()
    {
        return $this->belongsToMany(Currency::class, 'exchange_rates', 'base_currency', 'foreign_currency')->withPivot('rate')->withTimestamps();
    }

    // public function USDRate() {
    //     return $this->baseCurrency->first()->pivot->rate;
    // }

    private function getCurrencyFromParams($currency)
    {
        $c = null;
        if ($currency instanceof self) {
            $c = $currency;
        } else if (is_string($currency)) {
            $c = static::findOrFail($currency);
        } else {
            throw new \Exception("Invalid currency", 1);
        }
        return $c;
    }



    public function history($currency)
    {
        $c = $this->getCurrencyFromParams($currency);
        return $this->foreignCurrency()->orderBy('exchange_rates.created_at', 'desc')->wherePivot('foreign_currency', $c->id);
    }
}
