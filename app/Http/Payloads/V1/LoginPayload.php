<?php

declare(strict_types=1);

namespace App\Http\Payloads\V1;

final readonly class LoginPayload
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        private string $email,
        private string $password
    ) {
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
