<?php

namespace App\Http\Controllers;

use App\Facades\CSV;
use App\Facades\URL;
use App\Rules\ArrayInt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class FileUploadController extends Controller
{
    public function CSVStage1(Request $request)
    {
        $request->validate([
            'sheets_url' => [
                "required_without:csv_file",
                "url",
                "nullable"
            ],
            "csv_file" => [
                'file',
                "mimes:csv,txt",
                "required_without:sheets_url",
                "nullable"
            ]
        ]);

        if ($request->sheets_url) {
            $csv = CSV::fromGoogle(URL::make($request->sheets_url))->parse();
            // $csv->rows->prepend($csv->columns);
            return response()->json(["csv" => $csv, "longestRow" => $csv->getLongestRow()]);
        } else if ($request->csv_file) {
            $path = $request->file('csv_file')->store('csv');
        }
    }

    public function CSVStage2(Request $r)
    {
        $r->validate([
            'row_ids' => [
                "required",
                new ArrayInt
            ],
            'sheets_url' => [
                "required_without:csv_file",
                "url",
                "nullable"
            ],
            "csv_file" => [
                'file',
                "mimes:csv,txt",
                "required_without:sheets_url",
                "nullable"
            ]
        ]);
        $rows = array_map('intval', Str::of($r->row_ids)->explode(',')->all());
        $csv = CSV::fromGoogle(URL::make($r->sheets_url))->include($rows)->parse();
        // $csv->rows->prepend($csv->columns);
        return response()->json(["csv" => $csv, "longestRow" => $csv->getLongestRow()]);
    }

    public function CSVStage3(Request $r)
    {
        $r->validate([
            'row_ids' => [
                "required",
                new ArrayInt
            ],
            'sheets_url' => [
                "required_without:csv_file",
                "url",
                "nullable"
            ],
            "csv_file" => [
                'file',
                "mimes:csv,txt",
                "required_without:sheets_url",
                "nullable"
            ]
        ]);
        $rows = array_map('intval', Str::of($r->row_ids)->explode(',')->all());
        $csv = CSV::fromGoogle(URL::make($r->sheets_url))->include($rows)->parse();
        $data = [];
        foreach ($csv->columns as $column) {
            $data[$column] = $csv->get($column);
        }
        return response()->json(["data" => $data, "fields" => ["Size", "Color", "Image", "Name"]]);
    }
}
