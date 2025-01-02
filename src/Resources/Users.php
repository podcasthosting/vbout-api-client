<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\UserStatus;
use podcasthosting\VboutApiClient\UserType;
use podcasthosting\VboutApiClient\VboutClient;

class Users
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
     * GET /User/Users
     *
     * Ruft alle Listen ab. Optional kann man hier ein $queryParams-Array
     * übergeben, etwa Filter oder Paginierung (sofern von VBOUT unterstützt).
     *
     * @param  array  $queryParams  Beispiel: ['page' => 1, 'limit' => 20]
     * @return array
     */
    public function getUsers(array $queryParams = []): array
    {
        return $this->client->get('User/Users', $queryParams);
    }

    public function getManagers(): array
    {
        return $this->client->get('User/Managers');
    }


    /**
     * @param int $id
     * @param $type
     * @param $status
     * @return array
     * @throws \podcasthosting\VboutApiClient\Exceptions\VboutRequestException
     */
    public function getStatus(int $id, $type = UserType::USER, $status = UserStatus::ENABLE)
    {
        return $this->client->post("User/Status", ['id' => $id, 'type' => $type, 'status' => $status]);
    }

    // TODO: Add, Edit, Delete, Groups
}
