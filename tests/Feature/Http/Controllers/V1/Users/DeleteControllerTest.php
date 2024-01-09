<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Users\DeleteController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JustSteveKing\StatusCode\Http;

uses(RefreshDatabase::class);

it('deletes a user and returns the correct status code', function () {
    $user = User::factory()->create();

    $uuid = $user->uuid;
    $this->actingAs($user)
        ->deleteJson(action(DeleteController::class, ['uuid' => $uuid]))
        ->assertStatus(Http::NO_CONTENT->value);
});


it('returns 401 if user is not authenticated', function () {
    $user = User::factory()->create();

    $this->deleteJson(action(DeleteController::class, ['uuid' => $user->uuid]))
        ->assertStatus(Http::UNAUTHORIZED->value)
        ->assertJson([
            'message' => 'Unauthenticated.',
        ]);
});
