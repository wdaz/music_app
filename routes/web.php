<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $jsonString = file_get_contents(base_path('public/mock/mock.json'));
    $data = json_decode($jsonString, true);
    return view('home', ['data' => $data]);
})->name('home');

Route::get('/search', "SearchController@searchYT")->name('search');
Route::post('/search', "SearchController@searchYT")->name('search');

Route::get('/download/{videoId}', "DownloadController@processVideo")->name('download-page');
Route::get('/download', "DownloadController@videoDownload")->name('download');


