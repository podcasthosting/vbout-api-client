<?php

namespace podcasthosting\VboutApiClient;

use podcasthosting\VboutApiClient\Resources\Application;
use podcasthosting\VboutApiClient\Resources\Campaigns;
use podcasthosting\VboutApiClient\Resources\Contacts;
use podcasthosting\VboutApiClient\Resources\Lists;
use podcasthosting\VboutApiClient\Resources\Users;
use podcasthosting\VboutApiClient\Resources\Webhooks;

class Vbout
{
    protected VboutClient $client;

    public function __construct(string $apiKey)
    {
        $this->client = new VboutClient($apiKey);
    }

    /**
     * Kontakte-Resource
     */
    public function contacts(): Contacts
    {
        return new Contacts($this->client);
    }

    /**
     * User-Resource
     */
    public function users(): Users
    {
        return new Users($this->client);
    }

    /**
     * Listen-Resource
     */
    public function lists(): Lists
    {
        return new Lists($this->client);
    }

    public function application(): Application
    {
        return new Application($this->client);
    }

    public function campaigns(): Campaigns
    {
        return new Campaigns($this->client);
    }

    public function webhooks(): Webhooks
    {
        return new Webhooks($this->client);
    }
}

