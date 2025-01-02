<?php

namespace podcasthosting\VboutApiClient\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;

class VboutRequestException extends VboutException
{
    protected ?ResponseInterface $response;

    public function __construct(string $message, ?ResponseInterface $response = null, int $code = 0)
    {
        parent::__construct($message, $code);
        $this->response = $response;
    }

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }
}
