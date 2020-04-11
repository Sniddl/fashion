<?php

namespace App\Lib\CSV;

use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CSVParser
{
    public UploadedFile $file;
    public Collection $lines;
    public Collection $header;

    private array $excluded_rows;
    private array $included_rows;

    private bool $excluding = false;
    private bool $including = false;
    private bool $parsed = false;


    /**
     * Load CSV file for parsing.
     * 
     * @param Illuminate\Http\Uploadedfile $file
     * @return App\Lib\CSV\CSVParser
     */
    public function fromFile(UploadedFile $file)
    {
        $this->file = $file;
        return $this;
    }


    /**
     * Rows in the array will be excluded from the CSV before parsing.
     * 
     * @param array[int] $row_ids
     * @return App\Lib\CSV\CSVParser
     */
    public function exclude(array $row_ids)
    {
        if ($this->parsed) {
            throw new Exception("Cannot exlude rows after CSV is parsed. Use Arr::except() instead.", 1);
        }
        if ($this->including) {
            throw new Exception("Rows already marked for inclusion. Only include or exclude can be used, not both.", 1);
        }
        $this->excluding = true;
        $this->excluded_rows = $row_ids;
        return $this;
    }

    /**
     * Rows in the array will be the only included rows in the CSV before parsing.
     * 
     * @param array[int] $row_ids
     * @return App\Lib\CSV\CSVParser
     */
    public function include(array $row_ids)
    {
        if ($this->parsed) {
            throw new Exception("Cannot include rows after CSV is parsed. Use Arr::only() instead.", 1);
        }
        if ($this->excluding) {
            throw new Exception("Rows already marked for exclusion. Only include or exclude can be used, not both.", 1);
        }
        $this->including = true;
        $this->included_rows = $row_ids;
        return $this;
    }

    /**
     * Parse CSV data and put into CSV object.
     *
     * @return App\Lib\CSV\CSV
     */
    public function parse()
    {
        $this->parsed = true;
        $this->parseLines();
        $this->parseEntries();
        $this->parseHeader();

        $csv = new CSV;
        $csv->columns = $this->header;
        $csv->rows = $this->lines;
        return $csv;
    }

    /**
     * Take file contents and split into lines array.
     * 
     * @return App\Lib\CSV\CSVParser
     */
    private function parseLines()
    {
        $this->lines = Str::of($this->file->get())->explode("\n");

        if ($this->including) {
            $this->lines = $this->lines->only($this->included_rows)->flatten();
        } else if ($this->excluding) {
            $this->lines = $this->lines->except($this->excluded_rows)->flatten();
        }

        return $this;
    }

    /**
     * Split each line into seperate entries/fields.
     * 
     * @return App\Lib\CSV\CSVParser
     */
    private function parseEntries()
    {
        foreach ($this->lines as $key => $line) {
            $this->lines[$key] = Str::of($line)->explode(",");
        }
        return $this;
    }

    /**
     * Make the first line the header row.
     * 
     * @return App\Lib\CSV\CSVParser
     */
    private function parseHeader()
    {
        //
        $this->header = $this->lines->first();
        $this->lines = $this->lines->except(0);
        return $this;
    }
}
