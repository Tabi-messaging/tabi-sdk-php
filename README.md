# tabi/sdk

Official **PHP** SDK for the [Tabi](https://tabi.africa) WhatsApp Business Messaging API.

**Source of truth:** develop and release from [`Tabi-messaging/tabi-sdk-php`](https://github.com/Tabi-messaging/tabi-sdk-php) (Packagist tracks that repo). A copy may also exist under `projects/waapi/packages/tabi-sdk-php` in the WaAPI monorepo for reference—treat GitHub as canonical. See [`PUBLISHING.md`](./PUBLISHING.md).

**Requirements:** PHP 8.1+, ext-curl, ext-json.

## Install

```bash
composer require tabi/sdk
```

## Quick start

```php
<?php

use Tabi\SDK\TabiClient;

$tabi = new TabiClient(
    'tk_your_api_key_or_jwt',
    'https://api.tabi.africa/api/v1'
);

$channels = $tabi->channels()->list();
$tabi->messages()->send('channel-uuid', [
    'to' => '2348012345678',
    'content' => 'Hello from PHP!',
]);
```

## Resource groups (feature areas)

| Group | Client methods | Purpose |
|-------|----------------|---------|
| Getting started | `auth()`, `workspaces()` | Login/register/tokens; workspaces & members |
| Messaging | `channels()`, `messages()`, `conversations()`, `contacts()`, `quickReplies()`, `notifications()` | Lines, sends, inbox, contacts |
| Automations & campaigns | `automationTemplates()`, `automationInstalls()`, `campaigns()` | Templates, installs, broadcasts |
| Integrations | `apiKeys()`, `webhooks()`, `integrations()` | Keys, webhooks, external links |
| Media & insights | `files()`, `analytics()` | Uploads, stats |

## API keys — `create(array $data)`

`POST /api/v1/api-keys`. **Creating keys requires a user JWT** from the dashboard, not an API key.

| Key | Type | Required | Description |
|-----|------|----------|-------------|
| `name` | string | yes | Label in the dashboard |
| `channelId` | string (UUID) | no | Restrict key to one channel |
| `scopes` | string[] | no | e.g. `['channels:read', 'messages:send']`; omit for full access in scope |
| `expiresAt` | string (ISO 8601) | no | Key stops working after this time |

```php
$key = $tabi->apiKeys()->create([
    'name' => 'Production integration',
    'scopes' => ['messages:send', 'channels:read'],
]);
// $key['rawKey'] is shown only once — store it securely.
```

**List keys** (optional filter):

```php
$all = $tabi->apiKeys()->list();
$forChannel = $tabi->apiKeys()->list(['channelId' => 'uuid-here']);
```

## Documentation

- Public OpenAPI & guides: [tabi.africa/api-docs](https://tabi.africa/api-docs) (or your deployment’s `/api-docs`).
- JavaScript SDK (reference parity): [`tabi-sdk` on npm](https://www.npmjs.com/package/tabi-sdk).

## Support

- Issues: [tabi-sdk-php](https://github.com/Tabi-messaging/tabi-sdk-php) (see `composer.json` → `support`).

## License

MIT
