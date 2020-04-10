<?php

namespace App\Lib\CSV;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

class CSV extends Facade
{
    public $file;

    public function __construct()
    {
    }

    protected static function getFacadeAccessor()
    {
        return 'larashout';
    }

    public function make($file)
    {
        $this->file = $file;
        dump("hello");
    }
}
