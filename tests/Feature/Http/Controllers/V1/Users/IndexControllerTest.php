<?php

use App\Http\Controllers\V1\Users\IndexController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JustSteveKing\StatusCode\Http;

uses(RefreshDatabase::class);


it('returns the correct status code', function () {
    $this->getJson(action(IndexController::class))
        ->assertStatus(status: Http::OK->value);
});

it('returns valid data', function () {
    User::factory(10)->create();
    $this->getJson(action(IndexController::class))
        ->assertStatus(status: Http::OK->value)
        ->assertJsonStructure([
            [
                'id',
                'first_name',
                'last_name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at'
            ]
        ]);
});
