# oauth2-psn

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

[![Build Status][ico-phpeye]][link-phpeye]
[![PSR2 Conformance][ico-styleci]][link-styleci]

PSN OAuth 2.0 Client Provider for the PHP League's [OAuth2-Client](https://github.com/thephpleague/oauth2-client), for PHP 5.5.9+.

## Installation

To install, use composer:

```
composer require larabros/oauth2-psn
```

## Usage

Usage is the same as the League OAuth2 client, using `\League\OAuth2\Client\Provider\Psn` as the provider.

### Authorization Code Flow

```php
$provider = new League\OAuth2\Client\Provider\Psn([
    'clientId'          => '{psn-client-id}',
    'clientSecret'      => '{psn-client-secret}',
    'redirectUri'       => 'https://example.com/callback-url',
]);

if (!isset($_GET['code'])) {

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: '.$authUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    // Try to get an access token (using the authorization code grant)
    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);

    // Optional: Now you have a token you can look up a users profile data
    try {

        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
        printf('Hello %s!', $user->getPsnId());

    } catch (Exception $e) {

        // Failed to get user details
        exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->getToken();
}
```

### Managing Scopes

When creating your PSN authorization URL, you can specify the state and scopes your application may authorize.

```php
$options = [
    'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
    'scope' => ['psn:s2s'] // array or string
];

$authorizationUrl = $provider->getAuthorizationUrl($options);
```
If neither are defined, the provider will utilize internal defaults.

At the time of authoring this documentation, the following scopes are available:

- psn:s2s

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email contact@hassankhan.me instead of using the issue tracker.

## Credits

- [Hassan Khan][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/larabros/oauth2-psn.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/larabros/oauth2-psn/develop.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/larabros/oauth2-psn.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/larabros/oauth2-psn.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/larabros/oauth2-psn.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/larabros/oauth2-psn
[link-travis]: https://travis-ci.org/larabros/oauth2-psn
[link-scrutinizer]: https://scrutinizer-ci.com/g/larabros/oauth2-psn/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/larabros/oauth2-psn
[link-downloads]: https://packagist.org/packages/larabros/oauth2-psn
[link-author]: https://github.com/hassankhan
[link-contributors]: ../../contributors

[ico-phpeye]: http://php-eye.com/badge/larabros/oauth2-psn/tested.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/:styleci_repo/shield

[link-phpeye]: http://php-eye.com/package/larabros/oauth2-psn
[link-styleci]: https://styleci.io/repos/51898151/
