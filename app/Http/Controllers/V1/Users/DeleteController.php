<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Users;

use App\Http\Actions\Users\DeleteUser;
use App\Http\Controllers\Controller;
use App\Http\Queries\Users\FetchUserByUuid;
use App\Http\Responses\MessageResponse;
use JustSteveKing\StatusCode\Http;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Authenticated]
#[Group('Users')]
class DeleteController extends Controller
{
    public function __construct(
        private readonly DeleteUser $deleteUser,
        private readonly FetchUserByUuid $fetchUserByUuid
    ) {
    }

    public function __invoke(string $uuid)
    {
        $user = $this->fetchUserByUuid->handle($uuid);
        $this->deleteUser->handle($user);

        return new MessageResponse(
            data: [],
            status: Http::ACCEPTED,
            key: 'user'
        );
    }
}
