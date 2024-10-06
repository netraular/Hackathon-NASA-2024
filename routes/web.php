<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarDataController;
use App\Http\Controllers\SkyViewController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/exploreV1', function () {
    return view('skyview.exoskyV1');
});
Route::get('/exploreV2', function () {
    return view('skyview.exoskyV2');
});
Route::get('/exploreV3', function () {
    return view('skyview.layout');
});
Route::get('/info-resources', function () {
    return view('info-resources');
});

Route::get('/about', function () {
    return view('about');
});


Route::get('/skyview/{view?}', [SkyViewController::class, 'index'])
    ->where('view', '[A-Za-z0-9\s_\-\*]+')
    ->defaults('view', 'exoplanets');
    
Route::get('/test-script', [StarDataController::class, 'testScript'])->name('test.script');
Route::get('/stardata/uploadstars', [StarDataController::class, 'showUploadStarsForm'])->name('csv.upload');
Route::post('/stardata/processnewstars', [StarDataController::class, 'processNewStars'])->name('csv.process');
