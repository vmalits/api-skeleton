<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JustSteveKing\StatusCode\Http;

class CollectionResponse implements Responsable
{
    public function __construct(
        private readonly array|ResourceCollection|AnonymousResourceCollection $data,
        private readonly Http $status = Http::OK
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: $this->data,
            status: $this->status->value
        );
    }
}
