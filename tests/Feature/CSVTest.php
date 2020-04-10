<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CSVTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testFileUpload()
    {
        Storage::fake('test');

        $file = UploadedFile::fake()->createWithContent('file.csv', "name,title,desc\nlorem,ipsum,dolor color");

        $response = $this->json('POST', '/upload/csv', [
            'csv' => $file,
        ]);

        // Assert the file was stored...
        Storage::disk('test')->assertExists($file->hashName());
    }
}
