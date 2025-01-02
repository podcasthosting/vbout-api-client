<?php

namespace podcasthosting\VboutApiClient;

use GuzzleHttp\Client as Guzzle;
use podcasthosting\VboutApiClient\Exceptions\VboutRequestException;
use Psr\Http\Message\ResponseInterface;

class VboutClient
{
    protected string $baseUrl = 'https://api.vbout.com/1/';
    protected string $apiKey;
    protected int $timeout = 15;
    protected int $version = 1;
    protected Guzzle $client;

    /**
     * @param string $apiKey
     * @param int $timeout
     * @param string $baseUrl
     * @param int $version
     */
    public function __construct($apiKey, $baseUrl = null, $version = 1, $timeout = 15)
    {
        $this->apiKey  = $apiKey;
        $this->timeout = (int) ($timeout ?? $this->timeout);

        if (!is_null($baseUrl)) {
            $this->baseUrl = $baseUrl . '/' . $version ?? $this->version . '/';
        }

        $this->client  = new Guzzle([
            'base_uri' => $this->baseUrl,
            'timeout'  => $this->timeout,
        ]);
    }

    /**
     * Sendet eine POST-Anfrage an einen Endpoint.
     *
     * @param  string  $endpoint
     * @param  array   $data
     * @return array   Antwort als assoziatives Array
     *
     * @throws VboutRequestException
     */
    public function post(string $endpoint, array $data = []): array
    {
        try {
            /** @var ResponseInterface $response */
            $response = $this->client->post(strtolower($endpoint), [
                'headers' => [
                    'Accept'        => 'application/json',
                ],
                'query' => [
                    'key' => $this->apiKey,
                ],
                'json'    => $data,
            ]);
        } catch (\Exception $e) {
            throw new VboutRequestException("POST request to '{$endpoint}' failed: {$e->getMessage()}");
        }

        return $this->handleResponse($response, $endpoint);
    }

    /**
     * Sendet eine GET-Anfrage an einen Endpoint.
     */
    public function get(string $endpoint, array $query = []): array
    {
        try {
            $query['key'] = $this->apiKey;
            /** @var ResponseInterface $response */
            $response = $this->client->get(strtolower($endpoint), [
                'headers' => [
                    'Accept'        => 'application/json',
                ],
                'query'   => $query,
            ]);
        } catch (\Exception $e) {
            throw new VboutRequestException("GET request to '{$endpoint}' failed: {$e->getMessage()}");
        }

        return $this->handleResponse($response, $endpoint);
    }

    /**
     * Wertet die Response aus und gibt bei Fehler eine Exception.
     */
    protected function handleResponse(ResponseInterface $response, string $endpoint): array
    {
        $statusCode = $response->getStatusCode();
        $body       = (string) $response->getBody();
        $decoded    = json_decode($body, true);

        if ($statusCode < 200 || $statusCode >= 300) {
            throw new VboutRequestException(
                "Request to '{$endpoint}' failed with status code {$statusCode}",
                $response,
                $statusCode
            );
        }

        return $decoded ?: [];
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
