<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Broadcast campaigns.
 *
 * @see https://tabi.africa/api-docs
 */
class Campaigns
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array{
     *   name: string,
     *   channelId: string,
     *   content: string,
     *   messageType?: string,
     *   mediaUrl?: string,
     *   audienceFilter?: array<string, mixed>,
     *   batchSize?: int,
     *   batchIntervalMs?: int,
     *   scheduledAt?: string
     * } $data `scheduledAt` is an ISO 8601 string when scheduling
     */
    public function create(array $data): mixed
    {
        return $this->http->post('/campaigns', $data);
    }

    /**
     * @param array{
     *   page?: int,
     *   limit?: int,
     *   search?: string,
     *   sortBy?: string,
     *   sortOrder?: 'ASC'|'DESC'
     * }|null $query
     */
    public function list(?array $query = null): mixed
    {
        return $this->http->get('/campaigns', $query);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/campaigns/{$id}");
    }

    /**
     * @param array{
     *   name?: string,
     *   content?: string,
     *   messageType?: string,
     *   mediaUrl?: string,
     *   audienceFilter?: array<string, mixed>,
     *   batchSize?: int,
     *   batchIntervalMs?: int,
     *   scheduledAt?: string
     * } $data
     */
    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/campaigns/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/campaigns/{$id}");
    }

    public function schedule(string $id): mixed
    {
        return $this->http->post("/campaigns/{$id}/schedule");
    }

    public function pause(string $id): mixed
    {
        return $this->http->post("/campaigns/{$id}/pause");
    }

    public function resume(string $id): mixed
    {
        return $this->http->post("/campaigns/{$id}/resume");
    }

    public function cancel(string $id): mixed
    {
        return $this->http->post("/campaigns/{$id}/cancel");
    }
}
