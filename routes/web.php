<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {

    $endpoint = config('app.endpoints.sms_url');
    
    Http::post($endpoint, [
        'phoneNumber' => "228$phone",
        'message' => strtoupper($message),
    ]);


    return view('welcome');
});
