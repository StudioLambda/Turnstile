<?php

namespace LambdaStudio\Turnstile\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\SerializesModels;

class TurnstileResponse
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

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
