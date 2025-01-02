<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\VboutClient;

class Lists
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
     * @return array
     * @throws \podcasthosting\VboutApiClient\Exceptions\VboutRequestException
     */
    public function getLists(): array
    {
        return $this->client->get('EmailMarketing/GetLists');
    }

    /**
     * @param int $id
     * @return array
     * @throws \podcasthosting\VboutApiClient\Exceptions\VboutRequestException
     */
    public function get(int $id): array
    {
        return $this->client->get('EmailMarketing/GetList', [
            'id' => $id,
        ]);
    }

    /**
     * @param string $name
     * @param array $data
     * @return array
     * @throws \podcasthosting\VboutApiClient\Exceptions\VboutRequestException
     */
    public function add(string $name, array $data = []): array
    {
        $data['name'] = $name;

        return $this->client->post('EmailMarketing/AddList', $data);
    }

    /**
     * @param int $id
     * @param string $name
     * @param array $data
     * @return array
     * @throws \podcasthosting\VboutApiClient\Exceptions\VboutRequestException
     */
    public function update(int $id, string $name, array $data = []): array
    {
        $data['id'] = $id;
        $data['name'] = $name;

        return $this->client->post('EmailMarketing/AddList', $data);
    }

    /**
     * @param int $id
     * @return array
     * @throws \podcasthosting\VboutApiClient\Exceptions\VboutRequestException
     */
    public function delete(int $id): array
    {
        return $this->client->post('EmailMarketing/DeleteList', [
            'id' => $id,
        ]);
    }

    /**
     * @param int $id
     * @param string $description
     * @param string $dateTime
     * @return array
     * @throws \podcasthosting\VboutApiClient\Exceptions\VboutRequestException
     */
    public function addActivity(int $id, string $description, string $dateTime): array
    {
        return $this->client->post('EmailMarketing/AddActivity', [
            'id' => $id,
            'description' => $description,
            'datetime' => $dateTime,
        ]);
    }
}
