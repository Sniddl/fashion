<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function csv(Request $request)
    {
        $path = $request->file('csv')->store('test');

        // return $path;
        dd("hello");
    }
}
