<?php

namespace App\Lib\CSV;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class CSV
{
    public Collection $rows;
    public Collection $columns;

    public function __construct()
    {
    }

    /**
     * Get all the data in a specified column.
     * 
     * @param string $column
     * @return Illuminate\Support\Collection
     */
    public function get(string $column)
    {
        $index = array_search($column, $this->columns->toArray());
        return $this->rows->pluck("$index");
    }
}
