<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\VboutClient;

class Application
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

    /* ------------------------------------------------
     |  1) USER CUSTOM FIELDS
     ------------------------------------------------ */

    /**
     * GET /App/Me
     *
     * Ruft alle benutzerdefinierten Felder des Nutzers ab.
     * Optional können Query-Parameter mitgegeben werden, falls die API sie unterstützt (z.B. Paginierung).
     *
     * @param array $queryParams
     * @return array
     */
    public function me(array $queryParams = []): array
    {
        return $this->client->get('App/Me', $queryParams);
    }
}
