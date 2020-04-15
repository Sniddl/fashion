<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/upload/csv1', 'FileUploadController@CSVStage1');
Route::post('/upload/csv2', 'FileUploadController@CSVStage2');


Route::get('/upload', 'UploadController@index')->name('upload');

Route::get('/test', 'TestController@index')->name('test');
