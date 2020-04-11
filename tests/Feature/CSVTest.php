<?php

namespace Tests\Feature;

use App\Facades\CSV;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
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

        $csv1 = CSV::fromFile($file)->parse();
        $csv2 = CSV::fromFile($file)->include([0, 1])->parse();
        $csv3 = CSV::fromFile($file)->exclude([1])->parse();

        $this->assertEquals($csv1->get('name')->toArray(), ['lorem', 'lorem ipsum'], '"name" column');
        $this->assertEquals($csv1->get('title')->toArray(), ['ipsum', 'dolor solor'], '"title" column');
        $this->assertEquals($csv1->get('desc')->toArray(), ['dolor color', 'gipsum'], '"desc" column');

        $this->assertEquals($csv2->get('name')->toArray(), ['lorem'], '"name" column');
        $this->assertEquals($csv2->get('title')->toArray(), ['ipsum'], '"title" column');
        $this->assertEquals($csv2->get('desc')->toArray(), ['dolor color'], '"desc" column');

        $this->assertEquals($csv3->get('name')->toArray(), ['lorem ipsum'], '"name" column');
        $this->assertEquals($csv3->get('title')->toArray(), ['dolor solor'], '"title" column');
        $this->assertEquals($csv3->get('desc')->toArray(), ['gipsum'], '"desc" column');
    }

    /**
     * A test for importing CSV from Google Docs.
     *
     * @return void
     */
    // public function test_csv_from_google_docs()
    // {
    //     // create a fake file
    //     Storage::fake('test');

    //     $url = "https://docs.google.com/spreadsheets/d/1BVzVbgptpCN3LQ4vRC8iQHj7QatVcnPStc19CmpHQ4o/edit#gid=0";

    //     $csv = CSV::fromGoogle($url)
    //         ->exclude([1, 3, 7, 13, 20])
    //         ->parse();

    //     dd($csv);

    //     $this->assertEquals($csv->get('name')->toArray(), ['lorem', 'lorem ipsum'], '"name" column');
    //     $this->assertEquals($csv->get('title')->toArray(), ['ipsum', 'dolor solor'], '"title" column');
    //     $this->assertEquals($csv->get('desc')->toArray(), ['dolor color', 'gipsum'], '"desc" column');
    // }
}
