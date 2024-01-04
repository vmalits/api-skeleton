<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Payloads\V1\LoginPayload;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ];
    }

    public function payload(): LoginPayload
    {
        return new LoginPayload(
            email: $this->string('email')->toString(),
            password: $this->str('password')->toString()
        );
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'Email',
                'example' => 'john@doe'
            ],
            'password' => [
                'description' => 'Password',
                'example' => 'yqy5bjd7vkg@ckm5THG'
            ],
        ];
    }
}
