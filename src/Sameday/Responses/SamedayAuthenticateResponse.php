<?php

namespace Sameday\Responses;

use Sameday\Http\SamedayRawResponse;
use Sameday\Requests\SamedayAuthenticateRequest;
use Sameday\Responses\Traits\SamedayResponseTrait;

/**
 * Response for authenticate request.
 *
 * @package Sameday
 */
class SamedayAuthenticateResponse implements SamedayResponseInterface
{
    use SamedayResponseTrait;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * SamedayAuthenticateResponse constructor.
     *
     * @param SamedayAuthenticateRequest $request
     * @param SamedayRawResponse $rawResponse
     */
    public function __construct(SamedayAuthenticateRequest $request, SamedayRawResponse $rawResponse)
    {
        $this->request = $request;
        $this->rawResponse = $rawResponse;

        $json = json_decode($this->rawResponse->getBody(), true);
        $this->token = $json['token'];
        $this->expiresAt = \DateTime::createFromFormat('Y-m-d H:i', $json['expire_at']);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }
}