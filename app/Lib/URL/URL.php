<?php

namespace App\Lib\URL;

class URL
{
    public string $scheme;
    public string $host;
    public string $port;
    public string $user;
    public string $pass;
    public string $path;
    public string $query;
    public string $fragment;

    public function __construct(string $url = null)
    {
        $map = parse_url($url);
        if ($map['scheme'] != "https") {
            throw new \Exception("URL must be https sheme", 1);
        }
        foreach ($map as $key => $value) {
            $this->$key = $value;
        }
    }
}
