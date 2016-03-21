<?php

namespace Larabros\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

/**
 * Represents the owner of the access token.
 *
 * @package    OAuth2
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/larabros/oauth2-psn
 * @license    MIT
 */
class PsnResourceOwner implements ResourceOwnerInterface
{
    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response = array())
    {
        $this->response = $response;
    }

    /**
     * Get resource owner id
     *
     * @return string|null
     */
    public function getId()
    {
        return $this->response['accountId'] ?: null;
    }

    /**
     * Get PSN ID
     *
     * @return string|null
     */
    public function getPsnId()
    {
        return $this->response['onlineId'] ?: null;
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
