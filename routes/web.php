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

Route::get('/home', 'HomeController@index');

Route::prefix('csv')->name('csv.')->group(function () {
    Route::post('/stage-1', 'CSVController@CSVStage1')->name('1');
    Route::post('/stage-2', 'CSVController@CSVStage2')->name('2');
    Route::post('/stage-3', 'CSVController@CSVStage3')->name('3');
});


Route::get('/upload', 'UploadController@index');

Route::get('/test', 'TestController@index');

Route::get('/guide', 'GuideController@index');
