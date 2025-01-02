<?php
namespace podcasthosting\VboutApiClient;

enum WebhookType: string
{
    case EXIT = 'page_exit';

    case ENTRY = 'page_entry';

    case TRIGGER = 'goal_trigger';
}