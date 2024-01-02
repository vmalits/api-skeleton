<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Ping\ShowController;

use Illuminate\Testing\Fluent\AssertableJson;

it('returns the correct status code', function () {
    $this->getJson(action(ShowController::class))->assertStatus(200);
});

it('returns the correct payload', function () {
    $this->getJson(action(ShowController::class))->assertJson(
        fn (AssertableJson $json) => $json->where('message', 'Pong')->etc()
    );
});
