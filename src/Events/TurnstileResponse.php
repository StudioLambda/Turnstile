<?php

namespace LambdaStudio\Turnstile\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Http\Client\Response;

class TurnstileResponse
{
    use InteractsWithSockets;

    /**
     * Stores the HTTP response.
     *
     * @var Response
     */
    public Response $response;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
