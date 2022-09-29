<?php

namespace LambdaStudio\Turnstile\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use LambdaStudio\Turnstile\Events\TurnstileResponse;

class Turnstile implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => config('turnstile.secret_key'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        $this->onResponse($response);

        return $response->successful() && $response->json()['success'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The captcha response is not valid.';
    }
}
