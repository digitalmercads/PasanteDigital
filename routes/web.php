<?php

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
})->name('welcome');

Auth::routes();

Route::get('/profiles', 'ProfileController@index')->name('profiles');
Route::get('/upload', 'FileController@index')->name('upload_file');
Route::get('/judicial', 'JudicialController@index')->name('judicial');
Route::get('/judicial/{id}', 'JudicialController@showfiles')->middleware('property')->name('judicial_files');

Route::post('/add-file', 'FileController@store')->name('add_files');
Route::post('/add-judicial', 'JudicialController@store')->name('add_judicial');
