<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Ping\ShowController;
use JustSteveKing\StatusCode\Http;
use Illuminate\Testing\Fluent\AssertableJson;

it('returns the correct status code', function () {
    $this->getJson(action(ShowController::class))->assertStatus(status: Http::OK->value);
});

it('returns the correct payload', function () {
    $this->getJson(action(ShowController::class))->assertJson(
        fn (AssertableJson $json) => $json->where(key: 'message', expected: 'Pong')->etc()
    );
});
