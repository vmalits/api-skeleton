<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Responses\CollectionResponse;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Authenticated]
#[Group('Users')]
final class IndexController extends Controller
{
    #[ResponseFromApiResource(UserResource::class, User::class, paginate: 10)]
    public function __invoke(): Responsable
    {
        return new CollectionResponse(
            data: UserResource::collection(
                resource: User::query()->paginate(perPage: 10)
            )
        );
    }
}
