<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use JustSteveKing\StatusCode\Http;

readonly class ModelResponse implements Responsable
{
    public function __construct(
        private JsonResource $data,
        private string $key,
        private Http $status = Http::OK
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
