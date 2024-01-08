<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Users\DeleteController;
use App\Http\Controllers\V1\Users\IndexController;
use App\Http\Controllers\V1\Users\ShowController;

Route::get('/', IndexController::class)->name('index');
Route::get('/{uuid}', ShowController::class)->name('show');
Route::delete('/{uuid}', DeleteController::class)->name('delete');
