<?php

namespace App\Facades;

use App\Lib\CSV\CSV as CSVCSV;
use Illuminate\Support\Facades\Facade;

class CSV extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CSVCSV::class;
    }
}
