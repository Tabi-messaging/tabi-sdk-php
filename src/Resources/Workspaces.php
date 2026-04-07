<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Workspaces
{
    public function __construct(private readonly HttpClient $http) {}

    public function create(array $data): mixed
    {
        return $this->http->post('/workspaces', $data);
    }

    public function list(): mixed
    {
        return $this->http->get('/workspaces');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/workspaces/{$id}");
    }

    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/workspaces/{$id}", $data);
    }

    public function listMembers(string $id): mixed
    {
        return $this->http->get("/workspaces/{$id}/members");
    }

    public function inviteMember(string $id, array $data): mixed
    {
        return $this->http->post("/workspaces/{$id}/members/invite", $data);
    }
}
