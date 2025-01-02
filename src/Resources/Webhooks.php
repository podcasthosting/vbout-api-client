<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\VboutClient;

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
     * GET /Webhooks/GetWebhooks
     *
     * Ruft eine Liste aller Webhooks ab, optional paginiert oder gefiltert.
     * @param  array  $queryParams
     * @return array
     */
    public function getWebhooks(array $queryParams = []): array
    {
        // https://developers.vbout.com/docs#tag/Webhooks/operation/get-Webhooks-GetWebhooks
        return $this->client->get('Webhooks/GetWebhooks', $queryParams);
    }

    /**
     * GET /Webhooks/GetWebhook
     *
     * Ruft die Details eines einzelnen Webhooks ab.
     * @param  int|string  $webhookId
     * @param  array       $queryParams
     * @return array
     */
    public function getWebhook($webhookId, array $queryParams = []): array
    {
        // https://developers.vbout.com/docs#tag/Webhooks/operation/get-Webhooks-GetWebhook
        $queryParams['WebhookID'] = $webhookId;
        return $this->client->get('Webhooks/GetWebhook', $queryParams);
    }

    /**
     * POST /Webhooks/CreateWebhook
     *
     * Erstellt einen neuen Webhook. Das $data-Array sollte laut Doku Felder enthalten wie:
     * [
     *   "Name"      => "Mein Webhook",
     *   "Url"       => "https://meinserver.test/api/callback",
     *   "EventType" => "contact.added", // Beispiel - je nach VBOUT-Ereignis
     *   ...
     * ]
     *
     * @param  array  $data
     * @return array
     */
    public function createWebhook(array $data): array
    {
        // https://developers.vbout.com/docs#tag/Webhooks/operation/post-Webhooks-CreateWebhook
        return $this->client->post('Webhooks/CreateWebhook', $data);
    }

    /**
     * POST /Webhooks/UpdateWebhook
     *
     * Aktualisiert einen bestehenden Webhook. $data sollte mind. "WebhookID" enthalten.
     * [
     *   "WebhookID" => 1234,
     *   "Name"      => "Neuer Webhook-Name",
     *   "Url"       => "https://...",
     *   ...
     * ]
     *
     * @param  array  $data
     * @return array
     */
    public function updateWebhook(array $data): array
    {
        // https://developers.vbout.com/docs#tag/Webhooks/operation/post-Webhooks-UpdateWebhook
        return $this->client->post('Webhooks/UpdateWebhook', $data);
    }

    /**
     * POST /Webhooks/DeleteWebhook
     *
     * Löscht einen oder mehrere Webhooks (komma-separiert).
     * @param  int|int[]|string|string[]  $webhookIds
     * @return array
     */
    public function deleteWebhook($webhookIds): array
    {
        // https://developers.vbout.com/docs#tag/Webhooks/operation/post-Webhooks-DeleteWebhook
        if (is_array($webhookIds)) {
            $webhookIds = implode(',', $webhookIds);
        }

        return $this->client->post('Webhooks/DeleteWebhook', [
            'WebhookID' => $webhookIds,
        ]);
    }
}
