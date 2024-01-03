<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\V1\RegisterPayload;
use App\Models\User;
use Illuminate\Database\DatabaseManager;

readonly class IdentityService
{
    public function __construct(
        private DatabaseManager $database
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
}
