
<?php

use App\Http\Controllers\API\EventSportifController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    // EventSportif API Resource Routes
    Route::apiResource('eventSportifs', EventSportifController::class);


    });

//version 2 of the API
Route::prefix('v2')->group(function () {
    // EventSportif API Resource Routes
    Route::apiResource('eventSportifs', EventSportifController::class);
});
