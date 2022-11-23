<?php

namespace LambdaStudio\Turnstile\Rules;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Contracts\Validation\Rule;
use LambdaStudio\Turnstile\Contracts\Turnstile as TurnstileContract;

class ValidTurnstile implements Rule
{
    /**
     * Stores the turnstile instance to use.
     *
     * @var TurnstileContract
     */
    protected TurnstileContract $turnstile;

    /**
     * Stores the translator instance to use.
     *
     * @var Translator
     */
    protected Translator $translator;

    /**
     * Create a new rule instance.
     *
     * @param  TurnstileContract  $turnstile
     * @param  Translator  $translator
     */
    public function __construct(TurnstileContract $turnstile, Translator $translator)
    {
        $this->turnstile = $turnstile;
        $this->translator = $translator;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->turnstile->check($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->translator->get('turnstile::messages.invalid_captcha');
    }
}
