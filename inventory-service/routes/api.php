<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemController;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API Inventory Service Running'
    ]);
});
Route::apiResource('items', ItemController::class);
