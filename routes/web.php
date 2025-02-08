<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppInfoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app/{appId}', [AppInfoController::class, 'getIdInfoApp']);

