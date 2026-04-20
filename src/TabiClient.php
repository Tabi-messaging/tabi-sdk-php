<?php

declare(strict_types=1);

namespace Tabi\SDK;

use Tabi\SDK\Resources\{
    Auth,
    Channels,
    Messages,
    Contacts,
    Conversations,
    Webhooks,
    ApiKeys,
    Files,
    Campaigns,
    AutomationTemplates,
    AutomationInstalls,
    QuickReplies,
    Analytics,
    Notifications,
    Integrations,
    Workspaces,
};

/**
 * Tabi API client. Each fluent method returns a resource group aligned with REST paths
 * (e.g. channels(), messages(), apiKeys()).
 *
 * Pass a workspace or channel API key for integration calls, or a user JWT when an
 * endpoint requires dashboard auth (e.g. creating API keys).
 *
 * Request/query parameter shapes are documented on each resource method (PHPDoc `array{…}` keys)
 * and match the public OpenAPI schemas.
 *
 * @see https://tabi.africa/api-docs
 */
class TabiClient
{
    private HttpClient $http;

    public function __construct(string $apiKey, string $baseUrl = 'https://api.tabi.africa/api/v1')
    {
        $this->http = new HttpClient($baseUrl, $apiKey);
    }

    public function auth(): Auth
    {
        return new Auth($this->http);
    }

    public function channels(): Channels
    {
        return new Channels($this->http);
    }

    public function messages(): Messages
    {
        return new Messages($this->http);
    }

    public function contacts(): Contacts
    {
        return new Contacts($this->http);
    }

    public function conversations(): Conversations
    {
        return new Conversations($this->http);
    }

    public function webhooks(): Webhooks
    {
        return new Webhooks($this->http);
    }

    public function apiKeys(): ApiKeys
    {
        return new ApiKeys($this->http);
    }

    public function files(): Files
    {
        return new Files($this->http);
    }

    public function campaigns(): Campaigns
    {
        return new Campaigns($this->http);
    }

    public function automationTemplates(): AutomationTemplates
    {
        return new AutomationTemplates($this->http);
    }

    public function automationInstalls(): AutomationInstalls
    {
        return new AutomationInstalls($this->http);
    }

    public function quickReplies(): QuickReplies
    {
        return new QuickReplies($this->http);
    }

    public function analytics(): Analytics
    {
        return new Analytics($this->http);
    }

    public function notifications(): Notifications
    {
        return new Notifications($this->http);
    }

    public function integrations(): Integrations
    {
        return new Integrations($this->http);
    }

    public function workspaces(): Workspaces
    {
        return new Workspaces($this->http);
    }
}
