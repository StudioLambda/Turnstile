<?php

declare(strict_types=1);

namespace LambdaStudio\Turnstile\Exceptions;

use Exception;
use Illuminate\Contracts\Translation\Translator;

class InvalidCaptchaException extends Exception
{
    /**
     * Creates a new invalid captcha exception.
     *
     * @param  Translator  $translator
     */
    public function __construct(Translator $translator)
    {
        parent::__construct($translator->get('turnstile::messages.invalid_captcha'));
    }
}
