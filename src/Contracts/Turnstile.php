<?php

declare(strict_types=1);

namespace LambdaStudio\Turnstile\Contracts;

interface Turnstile
{
    /**
     * Checks the given value against cloudflare's captcha service.
     *
     * @param  string  $value
     * @return bool
     */
    public function check(string $value): bool;
}
