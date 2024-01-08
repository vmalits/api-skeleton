<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Users\DeleteController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JustSteveKing\StatusCode\Http;

uses(RefreshDatabase::class);


it('returns the correct status code', function () {
    $user = User::factory(1)->create()->first();
    $this->actingAs($user);
    $this->getJson(action(DeleteController::class, ['uuid' => $user->uuid]))
        ->assertStatus(status: Http::ACCEPTED->value);
});
