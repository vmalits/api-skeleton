<?php

declare(strict_types=1);


use Illuminate\Support\Facades\Route;

Route::prefix('ping')
    ->as('ping:')
    ->group(
        base_path('routes/v1/ping.php')
    );

Route::prefix('auth')
    ->as('auth:')
    ->group(
        base_path('routes/v1/auth.php')
    );

Route::middleware('auth:sanctum')
    ->prefix('users')
    ->as('users:')
    ->group(
        base_path('routes/v1/users.php')
    );
