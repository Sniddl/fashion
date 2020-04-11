<?php

namespace App\Lib\CSV;

use App\Lib\URL\URL;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CSVFactory
{
    /**
     * Load CSV file for parsing.
     * 
     * @param Illuminate\Http\Uploadedfile $file
     * @return App\Lib\CSV\CSVParser
     */
    public function fromFile(UploadedFile $file)
    {
        $csv = new CSVParser;
        return $csv->fromFile($file);
    }

    /**
     * Load CSV file from Google Doc link.
     * 
     * @param App\Lib\URL\Url $url
     * @return App\Lib\CSV\CSVParser
     */
    public function fromGoogle(URL $url)
    {
        $csv = new CSVParser;
        return $csv->fromGoogle($url);
    }
}
