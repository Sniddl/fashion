<?php

namespace App\Facades;

use App\Lib\URL\URLFactory;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for URL parsing library.
 * 
 * @method static \App\Lib\URL\URL make(string $url)
 *
 * @see \App\Lib\URL\URL
 */
class URL extends Facade
{
    protected static function getFacadeAccessor()
    {
        return URLFactory::class;
    }
}
