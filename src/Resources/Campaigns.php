<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Campaigns
{
    public function __construct(private readonly HttpClient $http) {}

    public function create(array $data): mixed
    {
        return $this->http->post('/campaigns', $data);
    }

    public function list(?array $query = null): mixed
    {
        return $this->http->get('/campaigns', $query);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/campaigns/{$id}");
    }

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
