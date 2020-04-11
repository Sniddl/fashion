<?php

namespace App\Lib\URL;


class URLFactory
{
    /**
     * Load CSV file for parsing.
     * 
     * @param string $url
     * @return App\Lib\URL\URL
     */
    public function make(string $url)
    {
        return new URL($url);
    }
}
