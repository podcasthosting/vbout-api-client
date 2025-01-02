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
     * GET /EmailMarketing/GetContact
     *
     * Ruft einen einzelnen Kontakt ab, entweder durch ID oder E-Mail.
     * Laut Doku kann man 'ContactID' oder 'Email' als Parameter übergeben.
     *
     * @param  string|int  $contactIdOrEmail
     * @param  array       $queryParams  Zusätzliche Filter (optional)
     * @return array
     */
    public function get($contactIdOrEmail, array $queryParams = []): array
    {
        // Je nachdem, ob es eine Zahl oder eine Email ist, setzen wir die passende Query:
        // (Manche VBOUT-Versionen unterstützen 'Email', andere 'ContactID', ggf. auch beides.)
        if (is_numeric($contactIdOrEmail)) {
            $queryParams['ContactID'] = $contactIdOrEmail;
        } else {
            $queryParams['Email'] = $contactIdOrEmail;
        }

        // https://developers.vbout.com/docs#tag/Contact/operation/get-EmailMarketing-GetContact
        return $this->client->get('EmailMarketing/GetContact', $queryParams);
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
    public function update(array $data): array
    {
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
