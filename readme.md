Disclaimer: This is an unofficial package for the Vbout API. This is in no way affiliated with VBOUT, Inc.

    use podcasthosting\VboutApiClient\Vbout;
    $vbout = new Vbout();

## Lists
    
    // Alle Listen abfragen
    $allLists = $vbout->lists()->getLists();
    
    // Einzelne Liste
    $oneList = $vbout->lists()->getList(1234);
    
    // Neue Liste erstellen
    $created = $vbout->lists()->createList([
    'Name' => 'Meine neue Liste',
    // ... weitere Felder laut Dokumentation
    ]);
    
    // Liste updaten
    $updated = $vbout->lists()->updateList([
    'ListID' => 1234,
    'Name'   => 'Umbenannte Liste',
    ]);
    
    // Liste(n) löschen
    $deleted = $vbout->lists()->deleteList([1234, 2345]);
    
    // Tag prüfen
    $tagCheck = $vbout->lists()->checkListTag(1234, 'Podcast');
    
    // Tag hinzufügen
    $tagAdded = $vbout->lists()->addListTag(1234, 'MyTag');
    
    // Tag entfernen
    $tagRemoved = $vbout->lists()->removeListTag(1234, 'MyTag');
    
    // Kontakte kopieren/verschieben
    $copyResult = $vbout->lists()->copyListContacts(1234, 5678, false); // false = kopieren, true = verschieben

## Application

    // Alle Pipelines abrufen
    $allPipelines = $vbout->application()->getPipelines();
    
    // Beispiel 3: Event submitten
    $eventResponse = $vbout->application()->submitEvent([
    'EventName' => 'PodcastPlayed',
    'Email'     => 'john.doe@example.com',
    'PodcastID' => 123,
    'Timestamp' => time(),
    ]);

## Campaigns
    
    // 1) Neue Kampagne erstellen
    $newCampaignData = [
    'Subject'    => 'Meine Test-Kampagne',
    'SenderName' => 'Mein Unternehmen',
    'ReplyTo'    => 'noreply@example.com',
    'ListID'     => 1234, // oder kommaseparierte ListeIDs
    // weitere Felder laut Doku ...
    ];
    $createdCampaign = $vbout->campaigns()->createCampaign($newCampaignData);
    
    // 2) Kampagne updaten
    $updated = $vbout->campaigns()->updateCampaign([
    'CampaignID' => 5678,
    'Subject'    => 'Neuer Betreff',
    // ...
    ]);
    
    // 3) Kampagnenübersicht abfragen
    $allCampaigns = $vbout->campaigns()->getCampaigns(['page' => 1, 'limit' => 20]);
    
    // 4) Test-Kampagne versenden
    $testResult = $vbout->campaigns()->sendTestCampaign([
    'CampaignID' => 5678,
    'Email'      => 'test@me.com,test2@me.com',
    ]);
    
    // 5) Zusammenfassung (Öffnungen, Klicks, etc.)
    $summary = $vbout->campaigns()->getCampaignSummary(5678);
    
    // 6) Detaillierte Öffnungen
    $opens = $vbout->campaigns()->getCampaignOpens(5678, ['page' => 1, 'limit' => 50]);

## Webhooks

    // 1) Alle Webhooks abrufen
    $allWebhooks = $vbout->webhooks()->getWebhooks();
    
    // 2) Einzelnen Webhook abrufen
    $oneWebhook = $vbout->webhooks()->getWebhook(1234);
    
    // 3) Neuen Webhook anlegen
    $newWebhook = $vbout->webhooks()->createWebhook([
    'Name'      => 'Kontakt hinzugefügt',
    'Url'       => 'https://meinedomain.test/vbout/webhook',
    'EventType' => 'contact.added',
    // evtl. weitere Felder ...
    ]);
    
    // 4) Webhook aktualisieren
    $updatedWebhook = $vbout->webhooks()->updateWebhook([
    'WebhookID' => 1234,
    'Name'      => 'Aktualisierter Webhook-Name',
    ]);
    
    // 5) Webhook löschen
    $deletedWebhook = $vbout->webhooks()->deleteWebhook(1234);
    // oder mehrere: ->deleteWebhook([1234, 5678]);