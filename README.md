# Turnstile (Cloudflare Captcha)

Quick and easy implementation of Turnstile for Laravel.

## Example request validation

```php
$request->validate([
    'cf-turnstile-response' => [
        'required',
        'string',
        new \LambdaStudio\Turnstile\Rules\Turnstile(),
    ],
]);
```

Just apply the rule to the `cf-turnstile-response` field.

## Example frontend implementation

```blade
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>

<body>
  <form method="POST" action="{{ url('/test') }}">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <div class="cf-turnstile" data-sitekey="{{ config('turnstile.site_key') }}"></div>
    <input type="submit" value="Submit">
  </form>
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
  <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</body>

</html>
```

## Todo

- [ ] Add a middleware equivalent of the rule
- [ ] Add blade macros
  - [ ] @turnstile(): Adds the turnstile division with the site_key on it.
  - [ ] @turnstyleScript(): Adds the turnstile script tag.
