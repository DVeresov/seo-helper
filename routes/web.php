<?php

use App\Http\Controllers\EditPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModxApiClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/structure', [ModxApiClientController::class, 'getStructure']);
//Route::get('/get-page', [ModxApiClientController::class, 'getStructure']);
Route::get('/edit', [EditPageController::class, 'getEditPage']);
