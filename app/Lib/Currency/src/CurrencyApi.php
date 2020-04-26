<?php

namespace Currency;

use Currency\Models\Currency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;

class CurrencyApi
{
    protected static $api = "https://api.exchangeratesapi.io";

    public static function fetch(string $endpoint = "/", array $params = [])
    {
        return collect(Http::get(static::$api . $endpoint, array_merge(["base" => "USD"], $params))->json());
    }

    public static function latest(array $params = [])
    {
        return static::fetch('/latest', $params);
    }

    public static function populateDB()
    {
        if (Schema::hasTable('currencies')) {
            if (Currency::all()->isEmpty()) {
                static::populateCurrencies();
            }
        }

        if (Schema::hasTable('exchange_rates')) {
            $newRates = DB::table('exchange_rates')->whereDate('created_at', '<', now()->addDay(1))->get();
            if ($newRates->isEmpty()) {
                static::populateRates();
            }
        }
    }

    public static function populateCurrencies()
    {
        foreach (config('currencies') as $currency) {
            Currency::create($currency);
        }
    }

    public static function populateRates()
    {
        $res = static::latest();
        foreach (Currency::all() as $base) {
            $inverseBaseUSDRate = 1 / ($base->rate ?? $res['rates'][$base->id]);
            foreach (Currency::all() as $foreign) {
                $foreignUSDRate = $foreign->rate ?? $res['rates'][$foreign->id];
                $base->foreignCurrency()->attach($foreign, [
                    'rate' => $inverseBaseUSDRate * $foreignUSDRate
                ]);
            }
        }
    }
}
