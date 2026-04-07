<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class ApiKeys
{
    public function __construct(private readonly HttpClient $http) {}

    public function create(array $data): mixed
    {
        return $this->http->post('/api-keys', $data);
    }

    public function list(): mixed
    {
        return $this->http->get('/api-keys');
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
