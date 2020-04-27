<?php

namespace App\Casts;

use Currency\Currency;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Money implements CastsAttributes
{

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes)
    {
        return money($value, $model->currency);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes)
    {
        $amount = $value;
        if ($value instanceof Currency) {
            $amount = $value->getAmount();
            $model->currency = $value->id;
        }
        return $amount;
    }
}
