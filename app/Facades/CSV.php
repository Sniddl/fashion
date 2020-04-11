<?php

namespace App\Facades;

use App\Lib\CSV\CSVFactory;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for CSV parsing library.
 * 
 * @method static \App\Lib\CSV\CSVParser fromFile(\Illuminate\Http\UploadedFile $file)
 *
 * @see \App\Lib\CSV\CSVParser
 */
class CSV extends Facade
{
    public static function getFacadeAccessor()
    {
        return CSVFactory::class;
    }
}
