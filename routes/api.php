<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
# Add this to head
use App\Http\Controllers\StudentController;


Route::middleware('api')->group(function () {
    Route::resource('students', StudentController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
