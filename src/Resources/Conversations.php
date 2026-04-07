<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Conversations
{
    public function __construct(private readonly HttpClient $http) {}

    public function list(?array $query = null): mixed
    {
        return $this->http->get('/conversations', $query);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/conversations/{$id}");
    }

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
