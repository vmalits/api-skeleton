<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Auth;

use App\Http\Payloads\V1\RegisterPayload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'min:2', 'max:255'],
            'last_name' => ['required', 'min:2', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => [
                'required',
                Password::min(9)->numbers()->letters()->mixedCase()->uncompromised(),
                'confirmed'
            ],
            'password_confirmation' => ['required']
        ];
    }

    public function payload(): RegisterPayload
    {
        return new RegisterPayload(
            firstName: $this->string('first_name')->toString(),
            lastName: $this->string('last_name')->toString(),
            email: $this->string('email')->toString(),
            password: $this->str('password')->toString()
        );
    }

    public function bodyParameters(): array
    {
        return [
            'first_name' => [
                'description' => 'First Name',
                'example' => 'John'
            ],
            'last_name' => [
                'description' => 'Last Name',
                'example' => 'Doe'
            ],
            'email' => [
                'description' => 'Email',
                'example' => 'john@doe'
            ],
            'password' => [
                'description' => 'Password',
                'example' => 'yqy5bjd7vkg@ckm5THG'
            ],
            'password_confirmation' => [
                'description' => 'Confirmation Password',
                'example' => 'yqy5bjd7vkg@ckm5THG'
            ]
        ];
    }
}
