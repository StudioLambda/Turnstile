<?php

declare(strict_types=1);

namespace LambdaStudio\Turnstile\Facades;

use Illuminate\Support\Facades\Facade;
use LambdaStudio\Turnstile\Contracts\Turnstile as TurnstileContract;

/**
 * @method static bool check(string $value)
 *
 * @see \LambdaStudio\Turnstile\Turnstile
 */
class Turnstile extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TurnstileContract::class;
    }
}
