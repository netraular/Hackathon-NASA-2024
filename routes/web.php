<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/exploreV1', function () {
    return view('exoskyV1');
});
Route::get('/exploreV2', function () {
    return view('exoskyV2');
});
Route::get('/exploreV3', function () {
    return view('exoskyV3');
});
Route::get('/info-resources', function () {
    return view('info-resources');
});

Route::get('/about', function () {
    return view('about');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
