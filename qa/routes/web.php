<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'import_export_controller@index')->name('index');
Route::post('import', 'import_export_controller@import')->name('import');

Route::get('/export_excel/excel', 'import_export_controller@excel')->name('export_excel.excel');
