<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Auth\LoginController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JustSteveKing\StatusCode\Http;

uses(RefreshDatabase::class);

it('returns unauthorized status code', function () {
    $this->postJson(action(LoginController::class), [
        'email' => 'johndoe@gmail.com',
        'password' => 'yqy5bjd7vkg@ckm5THG',
    ])->assertStatus(status: Http::UNAUTHORIZED->value)
        ->assertJson([
            'message' => 'Invalid credential.',
            'errors' => [
                'email' => ['Invalid credential.'],
            ],
        ]);
});

it('returns authorized status code', function () {
    User::factory()->create([
        'email' => 'johndoe@gmail.com',
        'password' => 'yqy5bjd7vkg@ckm5THG',
    ]);
    $this->postJson(action(LoginController::class), [
        'email' => 'johndoe@gmail.com',
        'password' => 'yqy5bjd7vkg@ckm5THG',
    ])->assertStatus(status: Http::OK->value)->assertJsonStructure(['token']);
});
