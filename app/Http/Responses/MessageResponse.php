<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use JustSteveKing\StatusCode\Http;

readonly class MessageResponse implements Responsable
{
    public function __construct(
        private array|string $data,
        private Http $status = Http::OK,
        private string $key = 'message'
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                $this->key => $this->data,
            ],
            status: $this->status->value,
        );
    }
}
