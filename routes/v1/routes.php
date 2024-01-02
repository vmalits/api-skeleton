<?php

declare(strict_types=1);


use Illuminate\Support\Facades\Route;

Route::prefix('ping')->as('ping:')->group(
    base_path('routes/v1/ping.php')
);
