<?php

namespace App\Lib\URL;

class URL
{
    public ?string $scheme = null;
    public ?string $host = null;
    public ?string $port = null;
    public ?string $user = null;
    public ?string $pass = null;
    public ?string $path = null;
    public array $query = [];
    public ?string $fragment = null;

    public function __construct(string $url = null)
    {
        $map = parse_url($url);
        $map['query'] ??= '';

        if ($map['scheme'] != "https") {
            throw new \Exception("URL must be https sheme", 1);
        }

        foreach ($map as $key => $value) {
            if ($key == "query") continue;
            $this->$key = $value;
        }

        parse_str($map["query"], $this->query);
    }

    public function __toString()
    {
        $res = $this->scheme . "://";
        if ($this->user && $this->pass) {
            $res .= $this->user . ":" . $this->pass . "@";
        } else if ($this->user) {
            $res .= $this->user . "@";
        }

        $res .= $this->host;

        if ($this->port) {
            $res .= ":" . $this->port;
        }

        $res .= $this->path;

        if ($this->query) {
            $res .= "?" . http_build_query($this->query);
        }
        if ($this->fragment) {
            $res .= "#" . $this->fragment;
        }
        return $res;
    }
}
