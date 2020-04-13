<?php

namespace App\Lib\CSV;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CSV
{
    public Collection $rows;
    public Collection $columns;
    public int $longestRow;

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

    /**
     * Guess empty strings bassed on the previous item.
     * 
     * @return App\Lib\CSV\CSV
     */
    public function guessFill()
    {
        foreach ($this->columns as $x => $column) {

            $items = $this->get($column);
            $last = Str::of("");
            foreach ($items as $y => $item) {
                $item = Str::of($item);
                if ($item->isEmpty()) {
                    $item = $last;
                }
                $this->rows[$y][$x] = $item;
                // dump($item);
                $last = $item;
            }
            // dd($this->get($column));
        }
        return $this;
    }

    public function getLongestRow()
    {
        if (!isset($this->longestRow)) {
            $rows = $this->rows;
            $rows->prepend($this->columns->values());
            $this->longestRow = $rows->map(fn ($x) => count($x))->max();
        }
        return $this->longestRow;
    }

    public function getColumns()
    {
        $columns = collect();
        for ($i = 0; $i < $this->getLongestRow(); $i++) {
            $columns->push($this->rows->pluck($i));
        }
        return $columns;
    }
}
