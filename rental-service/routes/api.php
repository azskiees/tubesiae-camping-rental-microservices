<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RentalController;

Route::apiResource(
    'rentals',
    RentalController::class
);
