<?php

namespace Tests\Feature;

use App\Facades\CSV;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CSVTest extends TestCase
{

    /**
     * A basic test that checks if file upload works.
     *
     * @return void
     */
    public function test_csv_file_upload()
    {
        // create a fake file
        Storage::fake('test');

        $file = UploadedFile::fake()
            ->createWithContent('file.csv', "name,title,desc\nlorem,ipsum,dolor color");

        $response = $this->post('/upload/csv', [
            'csv' => $file,
        ]);

        Storage::disk('test')->assertExists('csv/' . $file->hashName());
    }

    /**
     * A test that creates a simple csv file, parses it, and checks for accuracy.
     *
     * @return void
     */
    public function test_csv_parse()
    {
        // create a fake file
        Storage::fake('test');

        $file = UploadedFile::fake()
            ->createWithContent('file.csv', "name,title,desc\nlorem,ipsum,dolor color\nlorem ipsum,dolor solor,gipsum");

        $csv = CSV::make($file)->parse();

        $this->assertEquals($csv->get('name')->toArray(), ['lorem', 'lorem ipsum'], '"name" column');
        $this->assertEquals($csv->get('title')->toArray(), ['ipsum', 'dolor solor'], '"title" column');
        $this->assertEquals($csv->get('desc')->toArray(), ['dolor color', 'gipsum'], '"desc" column');
    }
}
