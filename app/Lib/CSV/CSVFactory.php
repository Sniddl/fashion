<?php

namespace App\Lib\CSV;

use Illuminate\Http\UploadedFile;

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
}
