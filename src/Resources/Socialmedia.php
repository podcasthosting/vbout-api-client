<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\VboutClient;

class Social
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

    // TODO: Implement
}
