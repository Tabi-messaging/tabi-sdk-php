# tabi/sdk

> Official **PHP** SDK for the **Tabi** WhatsApp Business Messaging API.

[![Latest Stable Version](https://img.shields.io/packagist/v/tabi/sdk.svg)](https://packagist.org/packages/tabi/sdk)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

---

## Table of Contents

- [Installation](#installation)
- [Getting Started](#getting-started)
- [Configuration](#configuration)
- [Resource groups](#resource-groups-feature-areas)
- [Resources](#resources)
  - [Auth](#auth)
  - [Channels](#channels)
  - [Messages](#messages)
  - [Contacts](#contacts)
  - [Conversations](#conversations)
  - [Webhooks](#webhooks)
  - [API Keys](#api-keys)
  - [Files](#files)
  - [Campaigns](#campaigns)
  - [Automation Templates](#automation-templates)
  - [Automation Installs](#automation-installs)
  - [Quick Replies](#quick-replies)
  - [Analytics](#analytics)
  - [Notifications](#notifications)
  - [Integrations](#integrations)
  - [Workspaces](#workspaces)
- [Error Handling](#error-handling)
- [Return values](#return-values)
- [Requirements](#requirements)
- [Related](#related)
- [Support](#support)
- [License](#license)

---

## Installation

```bash
composer require tabi/sdk
```

## Getting Started

```php
<?php

use Tabi\SDK\TabiClient;

$tabi = new TabiClient(
    'tk_your_api_key',
    'https://api.tabi.africa/api/v1'
);

$result = $tabi->messages()->send('your-channel-id', [
    'to' => '2348012345678',
    'content' => 'Hello from the Tabi PHP SDK!',
]);
```

**Where to find your credentials:**

| Value | Location |
|-------|----------|
| API key / JWT | Dashboard → Developer → API Keys (or login flow for JWT) |
| Base URL | `https://api.tabi.africa/api/v1` (default if you omit the second constructor argument) |
| Channel ID | Dashboard → Channels → open a channel → copy the ID from the URL |

## Configuration

```php
$tabi = new TabiClient(
    'tk_...',   // required — API key or JWT
    'https://api.tabi.africa/api/v1' // optional — defaults to production API base
);
```

---

## Resource groups (feature areas)

The SDK mirrors how the **Tabi API** is organised. Each method on `TabiClient` returns a resource object mapped to one REST area.

| Group | Client methods | What it covers |
|-------|----------------|----------------|
| Getting started | `auth()`, `workspaces()` | Login/register/tokens; workspaces, members, invites |
| Messaging & inbox | `channels()`, `messages()`, `conversations()`, `contacts()`, `quickReplies()`, `notifications()` | WhatsApp lines, sends, threads, people, shortcuts |
| Automations & campaigns | `automationTemplates()`, `automationInstalls()`, `campaigns()` | Template catalog, installed flows, broadcasts |
| Integrations | `apiKeys()`, `webhooks()`, `integrations()` | Keys (create with JWT), outbound webhooks, third-party links |
| Media & insights | `files()`, `analytics()` | Uploads, KPIs |

---

## Resources

### Auth

Login, register, refresh tokens, session helpers, and invite preview.

```php
$session = $tabi->auth()->login('user@example.com', 'password');

$tabi->auth()->register([
    'email' => 'user@example.com',
    'password' => 'securePassword',
    'firstName' => 'John',
    'lastName' => 'Doe',
    'workspaceName' => 'My Company',
]);

$tabi->auth()->refresh('your-refresh-token');

$me = $tabi->auth()->me();

$tabi->auth()->logout();

// Workspace invite link token (public preview)
$tabi->auth()->invitePreview('invite-token-from-link');
```

---

### Channels

Create, list, connect, and manage WhatsApp channels.

```php
$tabi->channels()->list();

$tabi->channels()->get('channel-id');

$tabi->channels()->create([
    'name' => 'Support Line',
    'provider' => 'go-whatsapp',
]);

$tabi->channels()->connect('channel-id');
$tabi->channels()->connect('channel-id', ['some' => 'payload']); // optional body

$tabi->channels()->status('channel-id');

$tabi->channels()->disconnect('channel-id');

$tabi->channels()->delete('channel-id');

// Requires user JWT — not a channel API key
$tabi->channels()->update('channel-id', ['riskEngineEnabled' => false]);

$tabi->channels()->reconnect('channel-id');
```

---

### Messages

Send text and rich messages, list timeline, reply, reactions, and media.

```php
$tabi->messages()->send('channel-id', [
    'to' => '2348012345678',
    'content' => 'Hello! How can we help you today?',
]);

$tabi->messages()->send('channel-id', [
    'to' => '2348012345678',
    'content' => 'Check this out!',
    'messageType' => 'image',
    'mediaUrl' => 'https://example.com/image.png',
]);

$tabi->messages()->send('channel-id', [
    'to' => '2348012345678',
    'content' => 'Here is your invoice',
    'messageType' => 'document',
    'mediaUrl' => 'https://example.com/invoice.pdf',
]);

$tabi->messages()->get('message-id');

$tabi->messages()->listByConversation('conversation-id', [
    'page' => 1,
    'limit' => 50,
]);

$tabi->messages()->reply('conversation-id', [
    'content' => 'Thanks for reaching out!',
]);

$tabi->messages()->sendPoll('channel-id', [
    'to' => '2348012345678',
    'question' => 'What do you prefer?',
    'options' => ['Option A', 'Option B', 'Option C'],
    'maxAnswer' => 1,
]);

$tabi->messages()->sendLocation('channel-id', [
    'to' => '2348012345678',
    'latitude' => 6.5244,
    'longitude' => 3.3792,
]);

$tabi->messages()->sendContact('channel-id', [
    'to' => '2348012345678',
    'contactName' => 'Jane Doe',
    'contactPhone' => '2348099999999',
]);

$tabi->messages()->sendSticker('channel-id', [
    'to' => '2348012345678',
    // sticker payload per API
]);

$tabi->messages()->react('channel-id', 'provider-msg-id', [
    'emoji' => '👍',
]);

$tabi->messages()->markRead('channel-id', 'provider-msg-id');

$tabi->messages()->edit('channel-id', 'provider-msg-id', [
    'content' => 'Updated message text',
]);

$tabi->messages()->revoke('channel-id', 'provider-msg-id');

$tabi->messages()->downloadMedia('channel-id', 'provider-msg-id');
```

---

### Contacts

Create, update, import, tags, and consent.

```php
$tabi->contacts()->list(['page' => 1, 'limit' => 20, 'search' => 'John']);

$tabi->contacts()->get('contact-id');

$tabi->contacts()->create([
    'phone' => '2348012345678',
    'firstName' => 'John',
    'lastName' => 'Doe',
    'email' => 'john@example.com',
]);

$tabi->contacts()->update('contact-id', ['firstName' => 'Jonathan']);

$tabi->contacts()->delete('contact-id');

$tabi->contacts()->import([
    'contacts' => [
        ['phone' => '2348012345678', 'firstName' => 'Alice'],
        ['phone' => '2348087654321', 'firstName' => 'Bob'],
    ],
]);

$tabi->contacts()->getTags('contact-id');
$tabi->contacts()->addTag('contact-id', 'vip');
$tabi->contacts()->removeTag('contact-id', 'vip');

$tabi->contacts()->optIn('contact-id');
$tabi->contacts()->optOut('contact-id');
```

---

### Conversations

List, update, resolve, reopen, and read state.

```php
$tabi->conversations()->list(['page' => 1, 'limit' => 25, 'status' => 'open']);

$tabi->conversations()->get('conversation-id');

$tabi->conversations()->update('conversation-id', [
    'assignedTo' => 'member-id',
]);

$tabi->conversations()->resolve('conversation-id');
$tabi->conversations()->reopen('conversation-id');
$tabi->conversations()->markRead('conversation-id');
```

---

### Webhooks

Subscriptions, delivery logs, secrets, and test capture.

```php
$tabi->webhooks()->create([
    'url' => 'https://example.com/webhook',
    'events' => ['message.received', 'message.sent', 'conversation.created'],
]);

$tabi->webhooks()->list();
$tabi->webhooks()->get('webhook-id');

$tabi->webhooks()->update('webhook-id', [
    'url' => 'https://example.com/new-webhook',
    'events' => ['message.received'],
]);

$tabi->webhooks()->ping('webhook-id');
$tabi->webhooks()->rotateSecret('webhook-id');

$tabi->webhooks()->deliveryLogs(['page' => 1, 'limit' => 50]);

$tabi->webhooks()->startTestCapture();
$tabi->webhooks()->testCaptureStatus();
$tabi->webhooks()->stopTestCapture();

$tabi->webhooks()->delete('webhook-id');
```

---

### API Keys

Create and manage API keys. **Creating keys requires a user JWT** from the dashboard (not an API key).

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `name` | string | yes | Label in the dashboard |
| `channelId` | string (UUID) | no | Restrict key to one channel |
| `scopes` | string[] | no | e.g. `['channels:read', 'messages:send']`; omit for full access in scope |
| `expiresAt` | ISO 8601 string | no | Key stops working after this time |

```php
$key = $tabi->apiKeys()->create([
    'name' => 'Production Key',
    'scopes' => ['messages:send', 'channels:read'],
]);
// $key['rawKey'] — save immediately; only returned once

$tabi->apiKeys()->list();
$tabi->apiKeys()->list(['channelId' => 'uuid-of-channel']);

$tabi->apiKeys()->revoke('key-id');
$tabi->apiKeys()->delete('key-id');
```

---

### Files

List files, metadata, signed URLs, delete.

```php
$tabi->files()->list();
$tabi->files()->get('file-id');
$tabi->files()->getUrl('file-id');
$tabi->files()->delete('file-id');
```

---

### Campaigns

Draft, schedule, and control broadcast campaigns.

```php
$tabi->campaigns()->create([
    'name' => 'Promo Blast',
    'channelId' => 'channel-id',
    'message' => ['text' => 'Flash sale — 50% off today!'],
    'audienceFilter' => ['tags' => ['subscribers']],
]);

$tabi->campaigns()->list(['page' => 1, 'limit' => 10]);
$tabi->campaigns()->get('campaign-id');

$tabi->campaigns()->update('campaign-id', ['name' => 'Updated Promo']);

$tabi->campaigns()->schedule('campaign-id');
$tabi->campaigns()->pause('campaign-id');
$tabi->campaigns()->resume('campaign-id');
$tabi->campaigns()->cancel('campaign-id');

$tabi->campaigns()->delete('campaign-id');
```

---

### Automation Templates

Browse the template catalog.

```php
$tabi->automationTemplates()->list();
$tabi->automationTemplates()->get('template-id');
```

---

### Automation Installs

Install, configure, enable/disable, uninstall.

```php
$tabi->automationInstalls()->install([
    'templateId' => 'template-id',
    'channelId' => 'channel-id',
    'config' => ['greeting' => 'Welcome!'],
]);

$tabi->automationInstalls()->list();
$tabi->automationInstalls()->get('install-id');

$tabi->automationInstalls()->update('install-id', [
    'config' => ['greeting' => 'Hi there!'],
]);

$tabi->automationInstalls()->enable('install-id');
$tabi->automationInstalls()->disable('install-id');
$tabi->automationInstalls()->uninstall('install-id');
```

---

### Quick Replies

Canned responses for agents.

```php
$tabi->quickReplies()->list();

$tabi->quickReplies()->create([
    'shortcut' => '/hello',
    'body' => 'Hello! How can I help you today?',
]);

$tabi->quickReplies()->update('reply-id', ['body' => 'Updated greeting']);
$tabi->quickReplies()->delete('reply-id');
```

---

### Analytics

Dashboard and reporting ranges (pass date/query params as arrays).

```php
$tabi->analytics()->dashboard(['from' => '2025-01-01', 'to' => '2025-01-31']);
$tabi->analytics()->channels(['from' => '2025-01-01', 'to' => '2025-01-31']);
$tabi->analytics()->conversations(['from' => '2025-01-01', 'to' => '2025-01-31']);
```

---

### Notifications

In-app notification inbox.

```php
$tabi->notifications()->list(['page' => 1, 'limit' => 20]);
$tabi->notifications()->markRead('notification-id');
$tabi->notifications()->markAllRead();
$tabi->notifications()->unreadCount();
```

---

### Integrations

Third-party providers (CRM, helpdesk, etc.).

```php
$tabi->integrations()->listProviders();

$tabi->integrations()->create([
    'providerId' => 'hubspot',
    'config' => ['apiKey' => 'hs_...'],
]);

$tabi->integrations()->list();
$tabi->integrations()->get('integration-id');
$tabi->integrations()->test('integration-id');
$tabi->integrations()->update('integration-id', [
    'config' => ['apiKey' => 'hs_new_key'],
]);
$tabi->integrations()->delete('integration-id');
```

---

### Workspaces

Workspaces and team members.

```php
$tabi->workspaces()->list();
$tabi->workspaces()->get('workspace-id');
$tabi->workspaces()->create(['name' => 'New Team']);
$tabi->workspaces()->update('workspace-id', ['name' => 'Renamed Team']);

$tabi->workspaces()->listMembers('workspace-id');

$tabi->workspaces()->inviteMember('workspace-id', [
    'email' => 'colleague@example.com',
    'roleSlug' => 'admin',
]);
```

---

## Error Handling

Failed HTTP responses throw `Tabi\SDK\TabiException` with the status code and decoded body when available.

```php
use Tabi\SDK\TabiClient;
use Tabi\SDK\TabiException;

$tabi = new TabiClient('tk_...');

try {
    $tabi->messages()->send('channel-id', ['to' => '234...', 'content' => 'Hi']);
} catch (TabiException $e) {
    echo $e->getMessage();   // API message
    echo $e->statusCode;     // e.g. 400, 401, 403, 404
    var_dump($e->body);     // full JSON error payload, if any
}
```

### Common HTTP status codes

| Status | Meaning |
|--------|---------|
| `400` | Bad request — check your payload |
| `401` | Unauthorized — invalid or expired token |
| `403` | Forbidden — insufficient permissions |
| `404` | Not found |
| `409` | Conflict — duplicate or invalid state |
| `429` | Rate limited — retry with backoff |
| `500` | Server error — contact support |

---

## Return values

Successful responses that use the API’s `{ "success": true, "data": ... }` envelope return the **`data`** value only (typically an array). Other successful shapes are returned as decoded JSON (`mixed`). Refer to the [API docs](https://tabi.africa/api-docs) for each endpoint’s schema.

---

## Requirements

- **PHP** >= 8.1  
- Extensions: **curl**, **json**

---

## Related

- **JavaScript / TypeScript:** [`tabi-sdk` on npm](https://www.npmjs.com/package/tabi-sdk)
- **HTTP reference:** [tabi.africa/api-docs](https://tabi.africa/api-docs)

---

## Support

- Issues: [github.com/Tabi-messaging/tabi-sdk-php/issues](https://github.com/Tabi-messaging/tabi-sdk-php/issues)

---

## License

MIT — see [LICENSE](LICENSE) for details.
