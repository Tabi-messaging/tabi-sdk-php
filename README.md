# tabi/sdk

Official PHP SDK for the **Tabi** WhatsApp business messaging API.

## Requirements

- PHP >= 8.1
- cURL extension
- JSON extension

## Install

```bash
composer require tabi/sdk
```

[Packagist package](https://packagist.org/packages/tabi/sdk) · [Source on GitHub](https://github.com/Tabi-messaging/tabi-sdk-php) · [Full app repo](https://github.com/Tabi-messaging/tabi-full-app-system)

## Quick start

```php
<?php

use Tabi\SDK\TabiClient;

$tabi = new TabiClient('tk_your_api_key', 'https://api.c36.online/api/v1');

// List channels
$channels = $tabi->channels()->list();

// Send a text message (API expects "content", not "text")
$tabi->messages()->send('channel-id', [
    'to' => '2348012345678',
    'content' => 'Hello from Tabi SDK!',
]);

// Send media (image, video, audio, document)
$tabi->messages()->send('channel-id', [
    'to' => '2348012345678',
    'content' => 'See attached',
    'messageType' => 'image',   // image | video | audio | document
    'mediaUrl' => 'https://example.com/image.png',
]);

// Send a poll
$tabi->messages()->sendPoll('channel-id', [
    'to' => '2348012345678',
    'question' => 'What do you prefer?',
    'options' => ['Option A', 'Option B', 'Option C'],
    'maxAnswer' => 1,
]);

// Send a contact card
$tabi->messages()->sendContact('channel-id', [
    'to' => '2348012345678',
    'contactName' => 'Jane Doe',
    'contactPhone' => '2348099999999',
]);

// Send a location
$tabi->messages()->sendLocation('channel-id', [
    'to' => '2348012345678',
    'latitude' => '6.5244',
    'longitude' => '3.3792',
]);
```

## Dashboard-only channel actions

Some endpoints require a **signed-in user JWT** (not a channel API key): `connect`, `disconnect`, `reconnect`, `delete`, and `update` (including toggling the risk engine). Use these from a server that holds a user access token, or call them from the Tabi dashboard.

```php
// Example with a workspace user JWT (not tk_ API key)
$tabi->channels()->update('channel-id', ['riskEngineEnabled' => false]);
$tabi->channels()->reconnect('channel-id');
```

## Resources

| Resource | Method | Description |
|----------|--------|-------------|
| Auth | `auth()` | Login, register, refresh, me |
| Channels | `channels()` | List, get, status; update/reconnect with JWT |
| Messages | `messages()` | Send (`content` + `to`), media, polls, reactions |
| Contacts | `contacts()` | CRUD, import, tags, opt-in/out |
| Conversations | `conversations()` | List, resolve, reopen |
| Webhooks | `webhooks()` | CRUD, ping, delivery logs |
| API Keys | `apiKeys()` | Create, list, revoke |
| Files | `files()` | List, get URL |
| Campaigns | `campaigns()` | CRUD, schedule, pause, cancel |
| Automation | `automationTemplates()`, `automationInstalls()` | Templates & installs |
| Quick Replies | `quickReplies()` | CRUD |
| Analytics | `analytics()` | Dashboard, channels, conversations |
| Notifications | `notifications()` | List, mark read |
| Integrations | `integrations()` | Providers & connections |
| Workspaces | `workspaces()` | Workspaces & members |

## Error handling

```php
use Tabi\SDK\TabiException;

try {
    $tabi->messages()->send('ch-id', ['to' => '234...', 'content' => 'Hi']);
} catch (TabiException $e) {
    echo $e->statusCode . ': ' . $e->getMessage();
}
```

## License

MIT — see [LICENSE](LICENSE).
