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
Route::get('/expedientes', 'JudicialController@index')->name('judicial');
Route::get('/expediente/upload', 'FileController@index')->name('upload_file');
Route::get('/expediente/{id}', 'JudicialController@showfiles')->middleware('property')->name('judicial_files');

Route::post('/add-file', 'FileController@store')->name('add_files');
Route::post('/add-expediente', 'JudicialController@store')->name('add_judicial');
Route::post('ajax/judicials-list', 'DynamicDependentController@judicials')->name('judicials_list');
Route::post('ajax/profile_update', 'DynamicDependentController@profile')->name('profile_update');
