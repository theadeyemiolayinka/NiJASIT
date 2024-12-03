<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\IssueArticlesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function () {
    Orion::resource('issues', IssueController::class)->withSoftDeletes();
    Orion::resource('articles', ArticleController::class)->withSoftDeletes();
    Orion::hasManyResource('issue', 'articles', IssueArticlesController::class)->withSoftDeletes();
});
