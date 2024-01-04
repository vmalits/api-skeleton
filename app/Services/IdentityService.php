<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\V1\LoginPayload;
use App\Http\Payloads\V1\RegisterPayload;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\DatabaseManager;
use Laravel\Sanctum\NewAccessToken;

readonly class IdentityService
{
    public function __construct(
        private DatabaseManager $database,
        private AuthManager $auth
    ) {
    }

    /**
     * @param RegisterPayload $payload
     * @return void
     * @throws \Throwable
     */
    public function register(RegisterPayload $payload): void
    {
        $this->database->transaction(
            callback: fn () => User::query()->create($payload->toArray()),
            attempts: 3
        );
    }

    public function getAuthenticatedUser(): User|null|Authenticatable
    {
        return $this->auth->user();
    }

    public function login(LoginPayload $payload): bool
    {
        return $this->auth->attempt(
            credentials: $payload->toArray()
        );
    }

    public function createToken(Authenticatable|User $user, string $name, array $permissions = ['*']): NewAccessToken
    {
        return $user->createToken(
            name: $name,
            abilities: $permissions
        );
    }
}
