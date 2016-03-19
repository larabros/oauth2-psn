<?php

namespace Larabros\OAuth2\Client\Provider\Tests;

use Larabros\OAuth2\Client\Provider\Psn;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Mockery as m;

class PsnTest extends TestCase
{
    /**
     * @var Psn
     */
    protected $provider;

    protected function setUp()
    {
        $this->provider = new Psn([
            'clientId' => 'mock_client_id',
            'clientSecret' => 'mock_secret',
            'redirectUri' => 'none',
        ]);
    }

    public function testAuthorizationUrl()
    {
        $url = $this->provider->getAuthorizationUrl();
        $uri = parse_url($url);
        parse_str($uri['query'], $query);

        $this->assertArrayHasKey('client_id', $query);
        $this->assertArrayHasKey('redirect_uri', $query);
        $this->assertArrayHasKey('state', $query);
        $this->assertArrayHasKey('scope', $query);
        $this->assertArrayHasKey('response_type', $query);
        $this->assertArrayHasKey('approval_prompt', $query);
        $this->assertNotNull($this->provider->getState());
    }


    public function testScopes()
    {
        $options = ['scope' => [uniqid(),uniqid()]];

        $url = $this->provider->getAuthorizationUrl($options);

        $this->assertContains(urlencode(implode(',', $options['scope'])), $url);
    }

    public function testGetAuthorizationUrl()
    {
        $url = $this->provider->getAuthorizationUrl();
        $uri = parse_url($url);

        $this->assertEquals('/2.0/oauth/authorize', $uri['path']);
    }

    public function testGetBaseAccessTokenUrl()
    {
        $params = [];

        $url = $this->provider->getBaseAccessTokenUrl($params);
        $uri = parse_url($url);

        $this->assertEquals('/2.0/oauth/token', $uri['path']);
    }

    public function testGetAccessToken()
    {
        $response = m::mock('Psr\Http\Message\ResponseInterface');
        $response->shouldReceive('getBody')->andReturn($this->getFixture('token.json', false));
        $response->shouldReceive('getHeader')->andReturn(['content-type' => 'json']);

        $client = m::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('send')->times(1)->andReturn($response);
        $this->provider->setHttpClient($client);

        $token = $this->provider->getAccessToken('authorization_code', ['code' => 'mock_authorization_code']);

        $this->assertEquals('at', $token->getToken());
        $this->assertNotNull($token->getExpires());
        $this->assertNotNull($token->getRefreshToken());
    }

    public function testUserData()
    {
        $userId = '2125866694095514939';

        $postResponse = m::mock('Psr\Http\Message\ResponseInterface');
        $postResponse->shouldReceive('getBody')->andReturn($this->getFixture('token.json', false));
        $postResponse->shouldReceive('getHeader')->andReturn(['content-type' => 'json']);

        $userResponse = m::mock('Psr\Http\Message\ResponseInterface');
        $userResponse->shouldReceive('getBody')->andReturn($this->getFixture('owner.json', false));
        $userResponse->shouldReceive('getHeader')->andReturn(['content-type' => 'json']);

        $client = m::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('send')
            ->times(2)
            ->andReturn($postResponse, $userResponse);
        $this->provider->setHttpClient($client);

        $token = $this->provider->getAccessToken('authorization_code', ['code' => 'mock_authorization_code']);
        $user = $this->provider->getResourceOwner($token);

        $this->assertEquals($userId, $user->getId());
        $this->assertEquals($userId, $user->toArray()['accountId']);
//        $this->assertEquals($name, $user->getName());
//        $this->assertEquals($name, $user->toArray()['full_name']);
//        $this->assertEquals($nickname, $user->getNickname());
//        $this->assertEquals($nickname, $user->toArray()['username']);
//        $this->assertEquals($picture, $user->getImageurl());
//        $this->assertEquals($picture, $user->toArray()['profile_picture']);
//        $this->assertEquals($description, $user->getDescription());
//        $this->assertEquals($description, $user->toArray()['bio']);
    }

    public function testExceptionThrownWhenErrorObjectReceived()
    {
        $message = uniqid();
        $status = rand(400,600);
        $postResponse = m::mock('Psr\Http\Message\ResponseInterface');
        $postResponse->shouldReceive('getBody')->andReturn('{"error":{"code":3174913,"message":"Unauthorized","messageKey":"UNAUTHORIZED"}}');

        $postResponse->shouldReceive('getHeader')->andReturn(['content-type' => 'json']);
        $postResponse->shouldReceive('getStatusCode')->andReturn($status);

        $client = m::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('send')
            ->times(1)
            ->andReturn($postResponse);
        $this->provider->setHttpClient($client);
        $this->setExpectedException(IdentityProviderException::class);
        $token = $this->provider->getAccessToken('authorization_code', ['code' => 'mock_authorization_code']);
    }

    public function testAnotherExceptionThrownWhenErrorObjectReceived()
    {
        $message = uniqid();
        $status = rand(400,600);
        $postResponse = m::mock('Psr\Http\Message\ResponseInterface');
        $postResponse->shouldReceive('getBody')->andReturn('{"error":"redirect_uri_mismatch","error_description":"Invalid redirect: null does not match one of the registered values.","error_code":4174}');

        $postResponse->shouldReceive('getHeader')->andReturn(['content-type' => 'json']);
        $postResponse->shouldReceive('getStatusCode')->andReturn($status);

        $client = m::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('send')
            ->times(1)
            ->andReturn($postResponse);
        $this->provider->setHttpClient($client);
        $this->setExpectedException(IdentityProviderException::class);
        $token = $this->provider->getAccessToken('authorization_code', ['code' => 'mock_authorization_code']);
    }

    public function testGetAuthenticatedRequest()
    {
        $method = 'GET';
        $url = 'https://vl.api.np.km.playstation.net/vl/api/v1/mobile/users/me/info';

        $accessTokenResponse = m::mock('Psr\Http\Message\ResponseInterface');
        $accessTokenResponse->shouldReceive('getBody')->andReturn($this->getFixture('token.json', false));
        $accessTokenResponse->shouldReceive('getHeader')->andReturn(['content-type' => 'json']);

        $client = m::mock('GuzzleHttp\ClientInterface');
        $client->shouldReceive('send')
            ->times(1)
            ->andReturn($accessTokenResponse);
        $this->provider->setHttpClient($client);

        $token = $this->provider->getAccessToken('authorization_code', ['code' => 'mock_authorization_code']);

        $authenticatedRequest = $this->provider->getAuthenticatedRequest($method, $url, $token);

        $this->assertInstanceOf('Psr\Http\Message\RequestInterface', $authenticatedRequest);
        // test header has bearer and x-np headers
//        $this->assertEquals($method, $authenticatedRequest->getMethod());
//        $this->assertContains('access_token=at', $authenticatedRequest->getUri()->getQuery());
    }
}
