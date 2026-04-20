<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Inbox conversations — list, assign, resolve.
 *
 * @see https://tabi.africa/api-docs
 */
class Conversations
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array{
     *   page?: int,
     *   limit?: int,
     *   search?: string,
     *   sortBy?: string,
     *   sortOrder?: 'ASC'|'DESC',
     *   status?: 'open'|'pending'|'resolved'|'archived',
     *   assignedTo?: string,
     *   unassigned?: string,
     *   channelId?: string,
     *   priority?: 'urgent'|'high'|'normal'|'low'
     * }|null $query `unassigned` is `'true'|'false'` as a string query flag where applicable
     */
    public function list(?array $query = null): mixed
    {
        return $this->http->get('/conversations', $query);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/conversations/{$id}");
    }

    /**
     * @param array{
     *   status?: 'open'|'pending'|'resolved'|'archived',
     *   assignedTo?: string,
     *   priority?: 'urgent'|'high'|'normal'|'low'
     * } $data
     */
    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/conversations/{$id}", $data);
    }

    public function resolve(string $id): mixed
    {
        return $this->http->post("/conversations/{$id}/resolve");
    }

    public function reopen(string $id): mixed
    {
        return $this->http->post("/conversations/{$id}/reopen");
    }

    public function markRead(string $id): mixed
    {
        return $this->http->post("/conversations/{$id}/read");
    }
}
