<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrintController;

Route::get('/test', function () {

    return view('welcome');
});

Route::get('/print{record}', [PrintController::class, 'stream'])->name("notationSheet.generate");
