<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Users\ShowController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JustSteveKing\StatusCode\Http;

uses(RefreshDatabase::class);


it('returns the correct status code', function () {
    $user = User::factory(1)->create()->first();
    $this->actingAs($user);
    $this->getJson(action(ShowController::class, ['uuid' => $user->uuid]))
        ->assertStatus(status: Http::OK->value);
});

it('returns valid data', function () {
    $user = User::factory(1)->create()->first();
    $this->actingAs($user);
    $this->getJson(action(ShowController::class, ['uuid' => $user->uuid]))
        ->assertStatus(status: Http::OK->value)
        ->assertJsonStructure([
            'user' => [
                'id',
                'uuid',
                'first_name',
                'last_name',
                'email',
                'email_verified_at',
                'created_at',
                'updated_at'
            ]
        ]);
});
