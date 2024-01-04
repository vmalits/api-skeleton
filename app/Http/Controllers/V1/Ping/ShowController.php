<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Ping;

use App\Http\Controllers\Controller;
use App\Http\Responses\MessageResponse;
use Illuminate\Http\Request;
use Knuckles\Scribe\Attributes\Group;

#[Group('Healthcheck')]
final class ShowController extends Controller
{
    public function __invoke(Request $request): MessageResponse
    {
        return new MessageResponse(
            data: 'Pong'
        );
    }
}
