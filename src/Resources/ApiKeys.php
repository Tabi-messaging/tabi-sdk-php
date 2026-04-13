<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Workspace API keys — list, create, revoke, delete.
 *
 * @see https://api.tabi.africa/api-docs (API Keys tag)
 */
class ApiKeys
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * Create a new API key. Requires a **user JWT** (dashboard session), not an API key.
     *
     * Request body keys:
     * - **name** (string, required) — label shown in Settings → API Keys
     * - **channelId** (string UUID, optional) — restrict key to one channel
     * - **scopes** (string[], optional) — e.g. `['channels:read','messages:send']`; omit for full access in scope
     * - **expiresAt** (string ISO 8601, optional) — key stops working after this instant
     *
     * Response `data` includes **rawKey** only once — persist it immediately.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): mixed
    {
        return $this->http->post('/api-keys', $data);
    }

    /**
     * List API keys for the workspace.
     *
     * @param array<string, string>|null $query e.g. `['channelId' => 'uuid']` to filter
     */
    public function list(?array $query = null): mixed
    {
        return $this->http->get('/api-keys', $query);
    }

    public function revoke(string $id): mixed
    {
        return $this->http->post("/api-keys/{$id}/revoke");
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/api-keys/{$id}");
    }
}
