<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Queries\Users\FetchUserByUuid;
use App\Http\Resources\UserResource;
use App\Http\Responses\ModelResponse;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Authenticated]
#[Group('Users')]
class ShowController extends Controller
{
    public function __construct(private readonly FetchUserByUuid $fetchUserByUuid)
    {
    }

    public function __invoke(string $uuid)
    {
        return new ModelResponse(
            data: UserResource::make(
                $this->fetchUserByUuid->handle($uuid)
            ),
            key: 'user'
        );
    }
}
