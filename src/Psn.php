<?php

namespace Larabros\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

/**
 * An OAuth2 provider class for PSN.
 *
 * @package    OAuth2
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/oauth2-psn
 * @license    MIT
 */
class Psn extends AbstractProvider
{
    /**
     * @var string Key used in the access token response to identify the resource owner.
     */
    const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'accountId';

    /**
     * {@inheritDoc}
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://auth.api.sonyentertainmentnetwork.com/2.0/oauth/authorize';
    }

    /**
     * {@inheritDoc}
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://auth.api.sonyentertainmentnetwork.com/2.0/oauth/token';
    }

    /**
     * {@inheritDoc}
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://vl.api.np.km.playstation.net/vl/api/v1/mobile/users/me/info';
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultScopes()
    {
        return ['psn:s2s'];
    }

    /**
     * {@inheritDoc}
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) {
            if (is_array($data['error'])) {
                throw new IdentityProviderException(
                    $data['error']['messageKey'].': '.$data['error']['message'] ?: $response->getReasonPhrase(),
                    $data['error']['code'] ?: $response->getStatusCode(),
                    $response
                );
            }

            throw new IdentityProviderException(
                $data['error_description'] ?: $response->getReasonPhrase(),
                $data['error_code'] ?: $response->getStatusCode(),
                $response
            );
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new PsnResourceOwner($response);
    }

    /**
     * {@inheritDoc}
     */
    protected function getAuthorizationHeaders($token = null)
    {
        return [
            'Bearer'            => $token,
            'X-NP-ACCESS-TOKEN' => $token,
        ];
    }
}
