<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\Exceptions\VboutRequestException;
use podcasthosting\VboutApiClient\VboutClient;
use podcasthosting\VboutApiClient\WebhookType;

class Webhooks
{
    /**
     * @var VboutClient
     */
    protected VboutClient $client;

    /**
     * Constructor.
     */
    public function __construct(VboutClient $client)
    {
        $this->client = $client;
    }

    /**
     * GET /WebHook/lists
     *
     * Ruft eine Liste aller Webhooks ab, optional paginiert oder gefiltert.
     * @param  array  $queryParams
     * @return array
     */
    public function getWebhooks(array $queryParams = []): array
    {
        return $this->client->get('Webhook/lists', $queryParams);
    }

    /**
     * GET /WebHook/show
     *
     * @param int $id
     * @return array
     * @throws VboutRequestException
     */
    public function get(int $id): array
    {
        $queryParams['id'] = $id;

        return $this->client->get('Webhook/show', $queryParams);
    }

    /**
     * POST /WebHook/Add
     *
     * @param string $name
     * @param WebhookType $type
     * @param array $data
     * @return array
     * @throws VboutRequestException
     */
    public function add(string $name, $type = WebhookType::EXIT, array $data = []): array
    {
        $data['name'] = $name;
        $data['type'] = $type;

        return $this->client->post('Webhook/Add', $data);
    }

    /**
     * POST /Webhooks/UpdateWebhook
     *
     * @param string $name
     * @param WebhookType $type
     * @param array $data
     * @return array
     * @throws VboutRequestException
     */
    public function update(string $name, $type = WebhookType::EXIT, array $data = []): array
    {
        return $this->client->post('Webhook/Edit', $data);
    }

    /**
     * POST /Webhook/Delete
     *
     * @param int $id
     * @return array
     * @throws VboutRequestException
     */
    public function delete(int $id): array
    {
        return $this->client->post('Webhook/Delete', [
            'id' => $id,
        ]);
    }
}
