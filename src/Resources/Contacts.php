<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\ContactStatus;
use podcasthosting\VboutApiClient\Exceptions\VboutRequestException;
use podcasthosting\VboutApiClient\VboutClient;

class Contacts
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
     * GET /EmailMarketing/GetContacts
     *
     * Ruft eine Liste von Kontakten ab, ggf. paginiert oder gefiltert.
     *
     * @return array
     */
    public function getContacts(int $listId): array
    {
        $queryParams = [
            'listId' => $listId,
        ];
        // https://developers.vbout.com/docs#tag/Contact/operation/get-EmailMarketing-GetContacts
        return $this->client->get('EmailMarketing/GetContacts', $queryParams);
    }

    /**
     * @param int $listId
     * @return array
     * @throws VboutRequestException
     */
    public function getContactsByPhone(int $listId): array
    {
        $queryParams = [
            'listid' => $listId,
        ];

        return $this->client->get('EmailMarketing/GetContactsByPhoneNumber', $queryParams);
    }

    /**
     * GET /EmailMarketing/GetContact
     *
     * @param int $id
     * @return array
     * @throws VboutRequestException
     */
    public function get(int $id): array
    {
        $queryParams = [
            'id' => $id,
        ];
        return $this->client->get('EmailMarketing/GetContact', $queryParams);
    }

    /**
     * GET /EmailMarketing/GetContactByEmail
     *
     * @param string $email
     * @param int|null $listId
     * @return array
     * @throws VboutRequestException
     */
    public function getContactByEmail(string $email, int $listId = null): array
    {
        $queryParams = [
            'email' => $email,
            'listid' => $listId,
        ];
        return $this->client->get('EmailMarketing/GetContactByEmail', $queryParams);
    }

    /**
     * POST /EmailMarketing/AddContact
     *
     * Creates a contact
     *
     * @param int $listId
     * @param ContactStatus $status
     * @param string|null $email
     * @param string|null $ipAddress
     * @param array $fields
     * @return array
     * @throws VboutRequestException
     */
    public function add(int $listId, ContactStatus $status = ContactStatus::ACTIVE, string $email = null, string $ipAddress = null, array $fields = []): array
    {
        $queryParams = [
            'status' => $status,
            'listid' => $listId,
        ];

        if (null !== $email) {
            $queryParams['email'] = $email;
        }

        if (null !== $ipAddress) {
            $queryParams['ipaddress'] = $ipAddress;
        }

        if (count($fields) > 0) {
            $queryParams['fields'] = $fields;
        }

        // https://developers.vbout.com/docs#tag/Contact/operation/post-EmailMarketing-AddContact
        return $this->client->post('EmailMarketing/AddContact', $queryParams);
    }

    /**
     * POST /EmailMarketing/EditContact
     *
     * @param  array  $data
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $data['id'] = $id;
        // https://developers.vbout.com/docs#tag/Contact/operation/post-EmailMarketing-UpdateContact
        return $this->client->post('EmailMarketing/EditContact', $data);
    }

    /**
     * POST /EmailMarketing/DeleteContact
     *
     * @param int $id The ID of the contact to delete.
     * @param int $listId The ID of the list to delete from.
     * @return array
     * @throws VboutRequestException
     */
    public function delete(int $id, int $listId): array
    {
        return $this->client->post('EmailMarketing/DeleteContact', [
            'id' => $id,
            'listid' => $listId,
        ]);
    }

    /**
     * POST /EmailMarketing/MoveContact
     *
     * Verschiebt Kontakte von einer Liste in eine andere.
     * @param int $id The ID of the contact.
     * @param int $fromListId The ID of the list to assign this contact from
     * @param int $toListId The ID of the list to assign this contact to.
     * @return array
     * @throws VboutRequestException
     */
    public function move(int $id, int $fromListId, int $toListId): array
    {
        return $this->client->post('EmailMarketing/MoveContacts', [
            'id' => $id,
            'listid' => $toListId,
            'sourceid'   => $fromListId,
        ]);
    }

    // TODO: Sync, Timeline
}
