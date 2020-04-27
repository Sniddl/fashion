<?php

if (!function_exists('money')) {
    function money($amount, $currency = "USD")
    {
        return new Currency($currency, $amount);
    }
}
