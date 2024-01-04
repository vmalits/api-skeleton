<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Auth\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JustSteveKing\StatusCode\Http;

uses(RefreshDatabase::class);

it('returns the correct status code', function () {
    $this->postJson(action(RegisterController::class), [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'johndoe@gmail.com',
        'password' => 'yqy5bjd7vkg@ckm5THG',
        'password_confirmation' => 'yqy5bjd7vkg@ckm5THG'
    ])->assertStatus(status: Http::CREATED->value);

    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@gmail.com',
    ]);
});

it('returns the validation error if first_name is empty', function () {
    $this->postJson(action(RegisterController::class))
        ->assertJsonValidationErrors('first_name');
});

it('returns the validation error if last_name is empty', function () {
    $this->postJson(action(RegisterController::class))
        ->assertJsonValidationErrors('last_name');
});

it('returns the validation error if email is empty', function () {
    $this->postJson(action(RegisterController::class))
        ->assertJsonValidationErrors('email');
});

it('returns the validation error if email already exists', function () {
    User::factory()
        ->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@gmail.com',
            'password' => 'yqy5bjd7vkg@ckm5THG',
        ]);
    $this->postJson(action(RegisterController::class), [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'johndoe@gmail.com',
        'password' => 'yqy5bjd7vkg@ckm5THG',
        'password_confirmation' => 'yqy5bjd7vkg@ckm5THG'
    ])->assertJson([
        'message' => 'The email has already been taken.',
        'errors' => [
            'email' => ['The email has already been taken.'],
        ],
    ]);
});

it('returns the validation error if password is empty', function () {
    $this->postJson(action(RegisterController::class), [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'johndoe@gmail.com',
    ])->assertJsonValidationErrors('password');
});

it('returns the validation error if password_confirmation is empty', function () {
    $this->postJson(action(RegisterController::class))
        ->assertJsonValidationErrors('password_confirmation');
});

it('returns the validation error if the passwords do not match', function () {
    $this->postJson(action(RegisterController::class), [
        'password' => 'yqy5bjd7vkg@ckm5THG',
        'password_confirmation' => 'password'
    ])->assertJsonValidationErrors('password');
});
