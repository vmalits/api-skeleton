<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Responses\MessageResponse;
use App\Services\IdentityService;
use JustSteveKing\StatusCode\Http;
use Knuckles\Scribe\Attributes\Group;

#[Group('Auth')]
final class RegisterController extends Controller
{
    public function __construct(private readonly IdentityService $identityService)
    {
    }

    /**
     * @throws \Throwable
     */
    public function __invoke(RegisterRequest $request): MessageResponse
    {
        $this->identityService->register($request->payload());

        return new MessageResponse(
            data: [],
            status: Http::CREATED
        );
    }
}
