<?php

namespace App\Lib\CSV;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\File\File;

class CSV
{
    public UploadedFile $file;
    public Collection $lines;
    public Collection $header;

    public function __construct()
    {
    }

    protected static function getFacadeAccessor()
    {
        return 'larashout';
    }

    public function make(UploadedFile $file)
    {
        $this->file = $file;
        return $this;
    }

    public function parse()
    {
        $this->parseLines()
            ->parseEntries()
            ->parseHeader();
        return $this;
    }

    public function get($key)
    {
        $index = array_search($key, $this->header->toArray());
        return $this->lines->pluck("$index");
    }

    private function parseLines()
    {
        $this->lines = Str::of($this->file->get())->explode("\n");
        return $this;
    }

    private function parseEntries()
    {
        foreach ($this->lines as $key => $line) {
            $this->lines[$key] = Str::of($line)->explode(",");
        }
        return $this;
    }

    private function parseHeader()
    {
        $this->header = $this->lines->first();
        $this->lines = $this->lines->except(0);
        return $this;
    }
}
