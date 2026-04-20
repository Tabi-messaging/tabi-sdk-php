<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Workspace API keys — create, list, revoke, delete.
 *
 * @see https://tabi.africa/api-docs
 */
class ApiKeys
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * Create a new API key. Requires a **user JWT** (dashboard session), not an API key.
     *
     * Response `data` includes **rawKey** only once — persist it immediately.
     *
     * @param array{
     *   name: string,
     *   channelId?: string,
     *   scopes?: string[],
     *   expiresAt?: string
     * } $data `expiresAt` is an ISO 8601 instant. `scopes` examples: `channels:read`, `messages:send`.
     */
    public function create(array $data): mixed
    {
        return $this->http->post('/api-keys', $data);
    }

    /**
     * List API keys for the workspace.
     *
     * @param array{channelId?: string}|null $query Pass `channelId` to restrict the list to keys for that channel
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
