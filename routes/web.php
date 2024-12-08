<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Server Name' => "NiJASIT COLENG; Bells University of Technology", 'Developer' => "TheAdeyemiOlayinka", 'Website' => "https://theadeyemiolayinka.com"];
    // return ['Laravel' => app()->version()];
});

require __DIR__ . '/auth.php';

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
