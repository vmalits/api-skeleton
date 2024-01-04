<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Responses\MessageResponse;
use App\Services\IdentityService;
use Illuminate\Validation\ValidationException;
use JustSteveKing\StatusCode\Http;
use Knuckles\Scribe\Attributes\Group;

#[Group('Auth')]
final class LoginController extends Controller
{
    public function __construct(private readonly IdentityService $identityService)
    {
    }

    public function __invoke(LoginRequest $request): MessageResponse
    {
        if (!$this->identityService->login($request->payload())) {
            throw ValidationException::withMessages(
                messages: [
                    'email' => 'Invalid credential.'
                ]
            )->status(Http::UNAUTHORIZED->value);
        }

        $token = $this->identityService->createToken(
            user: $this->identityService->getAuthenticatedUser(),
            name: 'mobile'
        );

        return new MessageResponse(
            data: $token->plainTextToken,
            key: 'token'
        );
    }
}
