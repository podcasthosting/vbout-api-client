<?php

namespace podcasthosting\VboutApiClient\Resources;

use podcasthosting\VboutApiClient\CampaignType;
use podcasthosting\VboutApiClient\Exceptions\VboutRequestException;
use podcasthosting\VboutApiClient\VboutClient;

class Campaigns
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
     * GET /EmailMarketing/Campaigns
     *
     * Ruft eine Liste aller Kampagnen ab (ggf. paginiert oder gefiltert).
     * @param  array  $queryParams
     * @return array
     */
    public function getCampaigns(array $queryParams = []): array
    {
        $defaultParams = [
            'filter' => 'all'
        ];

        $params = array_merge($defaultParams, $queryParams);
        // https://developers.vbout.com/docs#tag/Campaigns/operation/get-EmailMarketing-GetCampaigns
        return $this->client->get('EmailMarketing/Campaigns', $params);
    }

    /**
     * GET /EmailMarketing/GetCampaign
     *
     * Gets information for a campaign
     *
     * @param int $campaignId
     * @param CampaignType $type
     * @return array
     * @throws VboutRequestException
     */
    public function get(int $campaignId, $type = CampaignType::STANDARD): array
    {
        // https://developers.vbout.com/docs#tag/Campaigns/operation/get-EmailMarketing-GetCampaign
        $queryParams = [
            'id' => $campaignId,
            'type' => $type
        ];
        return $this->client->get('EmailMarketing/GetCampaign', $queryParams);
    }

    /**
     * POST /EmailMarketing/AddCampaign
     *
     * Creates a new campaign
     * @param  array  $data
     * @return array
     */
    public function add(string $name, string $subject, string $fromEmail, string $fromName, string $replyTo,
                        string $body, $type = CampaignType::STANDARD, bool $isScheduled = false, bool $isDraft = false,
                        $scheduledDatetime = null, int $audiences = null, string $lists = null): array
    {
        $queryParams = [
            'name' => $name,
            'subject' => $subject,
            'fromemail' => $fromEmail,
            'from_name' => $fromName,
            'reply_to' => $replyTo,
            'body' => $body,
            'type' => $type,
            'isscheduled' => $isScheduled,
            'isdraft' => $isDraft,
        ];

        if (!is_null($scheduledDatetime)) {
            $queryParams['scheduled_datetime'] = $scheduledDatetime;
        }

        if (!is_null($audiences)) {
            $queryParams['audiences'] = $audiences;
        }

        if (!is_null($lists)) {
            $queryParams['lists'] = $lists;
        }
        // https://developers.vbout.com/docs#tag/Campaigns/operation/post-EmailMarketing-AddCampaign
        return $this->client->post('EmailMarketing/AddCampaign', $queryParams);
    }

    /**
     * POST /EmailMarketing/EditCampaign
     *
     * Updates an existing campaign
     *
     * @see https://developers.vbout.com/docs#tag/Email-Marketing/operation/post-EmailMarketing-EditCampaign
     *
     * @param  array  $data
     * @return array
     */
    public function update(array $data): array
    {
        return $this->client->post('EmailMarketing/EditCampaign', $data);
    }

    /**
     * POST /EmailMarketing/DeleteCampaign
     *
     * Löscht eine oder mehrere Kampagnen (komma-separiert).
     * @param  int|int[]|string|string[] $campaignIds
     * @return array
     */
    public function delete(int $campaignId, $type = CampaignType::STANDARD): array
    {
        return $this->client->post('EmailMarketing/DeleteCampaign', [
            'id' => $campaignId,
            'type' => $type
        ]);
    }

    /**
     * List of tags can be sent as a batch, separated by a comma. Either email or id can be used.
     *
     * @param string $email
     * @param string $tag
     * @param int|null $id
     * @return array
     * @throws VboutRequestException
     */
    public function addTag(int $id = null, string $email = null, string $tag): array
    {
        if (is_null($id) && is_null($email)) {
            throw new VboutRequestException('Missing required parameter: id or email');
        }

        return $this->client->post('EmailMarketing/AddTag', [
            'id' => $id,
            'email' => $email,
            'tagname' => $tag,
        ]);
    }

    /**
     * List of tags can be sent as a batch, separated by a comma. Either email or id can be used
     *
     * @param string $email
     * @param string $tag
     * @param int|null $id
     * @return array
     * @throws VboutRequestException
     */
    public function removeTag(int $id = null, string $email = null, string $tag): array
    {
        if (is_null($id) && is_null($email)) {
            throw new VboutRequestException('Missing required parameter: id or email');
        }

        return $this->client->post('EmailMarketing/RemoveTag', [
            'id' => $id,
            'email' => $email,
            'tagname' => $tag,
        ]);
    }

    /**
     * @param string $email
     * @param int|null $campaignId
     * @return array
     * @throws VboutRequestException
     */
    public function getCoupon(string $email, int $campaignId = null): array
    {
        return $this->client->post('EmailMarketing/GetCoupon', [
            'email' => $email,
            'campaignid' => $campaignId
        ]);
    }

    /**
     * GET /Application/GetEmailTemplate
     *
     * @return array
     */
    public function getEmailTemplates(): array
    {
        return $this->client->get('Application/GetEmailTemplates');
    }

}
