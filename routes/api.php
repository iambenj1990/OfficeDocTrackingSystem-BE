<?php

use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\LibDocumentsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::prefix('/user')->group(function () {
    Route::get('/list', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/new', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/deactivate/{id}', [UserController::class, 'deactivate']);
});

Route::prefix('/library/document')->group(function () {
    Route::get('/list',[LibDocumentsController::class, 'index']);
    Route::get('/{id}',[LibDocumentsController::class, 'show']);
    Route::post('/new',[LibDocumentsController::class, 'store']);
    Route::put('/{id}',[LibDocumentsController::class, 'update']);
    Route::delete('/remove/{id}',[LibDocumentsController::class, 'destroy']);
});


Route::prefix('/documents')->group(function () {
    Route::get('/list', [DocumentsController::class, 'index']);
    Route::get('/{id}', [DocumentsController::class, 'show']);
    Route::post('/new', [DocumentsController::class, 'store']);
    Route::put('/{id}', [DocumentsController::class, 'update']);
    Route::delete('/remove/{id}', [DocumentsController::class, 'destroy']);
});
