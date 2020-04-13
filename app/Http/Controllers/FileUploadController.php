<?php

namespace App\Http\Controllers;

use App\Facades\CSV;
use App\Facades\URL;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function csv(Request $request)
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
            return back()->with([
                "csv" => $csv,
                "sheets_url" => $request->sheets_url
            ]);
        } else if ($request->csv_file) {
            $path = $request->file('csv_file')->store('csv');
        }
    }
}
