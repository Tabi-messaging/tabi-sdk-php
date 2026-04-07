<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Integrations
{
    public function __construct(private readonly HttpClient $http) {}

    public function listProviders(): mixed
    {
        return $this->http->get('/integrations/providers');
    }

    public function create(array $data): mixed
    {
        return $this->http->post('/integrations', $data);
    }

    public function list(): mixed
    {
        return $this->http->get('/integrations');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/integrations/{$id}");
    }

    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/integrations/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/integrations/{$id}");
    }

    public function test(string $id): mixed
    {
        return $this->http->post("/integrations/{$id}/test");
    }
}
