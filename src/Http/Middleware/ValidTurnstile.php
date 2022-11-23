<?php

declare(strict_types=1);

namespace LambdaStudio\Turnstile\Http\Middleware;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use LambdaStudio\Turnstile\Contracts\Turnstile;
use LambdaStudio\Turnstile\Exceptions\InvalidCaptchaException;

class ValidTurnstile
{
    /**
     * The turnstile instance.
     *
     * @var Turnstile
     */
    protected Turnstile $turnstile;

    /**
     * The app instance.
     *
     * @var Application
     */
    protected Application $app;

    /**
     * Determines the request key to use.
     *
     * @var string
     */
    protected static string $key = 'cf-turnstile-response';

    /**
     * Creates a new instance of the ValidTurnstile middleware.
     *
     * @param  Turnstile  $turnstile
     * @param  Application  $app
     */
    public function __construct(Turnstile $turnstile, Application $app)
    {
        $this->turnstile = $turnstile;
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! $this->turnstile->check($request->input(static::$key))) {
            throw $this->app->make(InvalidCaptchaException::class);
        }

        return $next($request);
    }
}
