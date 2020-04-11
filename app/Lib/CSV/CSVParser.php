<?php

namespace App\Lib\CSV;

use App\Lib\URL\URL;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CSVParser
{
    private string $content;
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
        $this->content = $file->get();
        return $this;
    }

    /**
     * Load CSV file from Google Docs url.
     * 
     * @param Illuminate\Http\Uploadedfile $file
     * @return App\Lib\CSV\CSVParser
     */
    public function fromGoogle(URL $url)
    {
        $url->path = Str::of($url->path)->explode("/")->slice(0, 4)->join("/") . "/export";
        $url->fragment = "";
        $url->query = [
            "format" => "csv"
        ];

        $res = Http::get($url);
        $this->content = $res->body();
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
        $this->parseHeader();


        $csv = new CSV;
        $csv->columns = collect($this->header->values());
        $csv->rows = collect($this->lines->values());
        return $csv;
    }

    /**
     * Take file contents and split into lines array.
     * 
     * @return App\Lib\CSV\CSVParser
     */
    private function parseLines()
    {

        $this->lines = Str::of($this->content)
            ->explode("\n")
            ->map(fn ($x) => collect(str_getcsv(Str::of($x)->trim())));

        if ($this->including) {
            $this->lines = $this->lines->only($this->included_rows);
        } else if ($this->excluding) {
            $this->lines = $this->lines->except($this->excluded_rows);
        }

        // $this->lines = collect($this->lines);

        return $this;
    }

    /**
     * Make the first line the header row.
     * 
     * @return App\Lib\CSV\CSVParser
     */
    private function parseHeader()
    {
        $this->lines = collect($this->lines->values());
        $this->header = collect($this->lines->first());
        $this->lines = collect($this->lines->except(0));
        return $this;
    }
}
