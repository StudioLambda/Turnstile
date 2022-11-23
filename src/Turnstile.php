<?php

declare(strict_types=1);

namespace LambdaStudio\Turnstile;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use LambdaStudio\Turnstile\Contracts\Turnstile as TurnstileContract;
use LambdaStudio\Turnstile\Events\TurnstileResponse;

class Turnstile implements TurnstileContract
{
    /**
     * Stores the HTTP client to use.
     *
     * @var Factory
     */
    protected Factory $http;

    /**
     * Stores the config repository to use.
     *
     * @var Repository
     */
    protected Repository $config;

    /**
     * Stores the request to use.
     *
     * @var Request
     */
    protected Request $request;

    /**
     * Creates a new instance of the Turnstile class.
     *
     * @param  Factory  $http
     * @param  Repository  $config
     * @param  Request  $request
     */
    public function __construct(Factory $http, Repository $config, Request $request)
    {
        $this->http = $http;
        $this->config = $config;
        $this->request = $request;
    }

    /**
     * Requesta a new captcha response from cloudflare.
     *
     * @param  string  $value
     * @return Response
     */
    protected function request(string $value): Response
    {
        return $this->http->asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $this->config->get('turnstile.secret_key'),
            'response' => $value,
            'remoteip' => $this->request->ip(),
        ]);
    }

    /**
     * Callback that executes after a response from cloudflare.
     *
     * @param  Response  $response
     * @return void
     */
    protected function onResponse(Response $response): void
    {
        event(new TurnstileResponse($response));
    }

    /**
     * Checks the given value against cloudflare's captcha service.
     *
     * @param  string  $value
     * @return bool
     */
    public function check(string $value): bool
    {
        $response = $this->request($value);

        $this->onResponse($response);

        return $response->successful() && $response->json()['success'];
    }
}
