<?php

if (!function_exists('money')) {
    function money($currency, $amount)
    {
        return new Currency($currency, $amount);
    }
}
