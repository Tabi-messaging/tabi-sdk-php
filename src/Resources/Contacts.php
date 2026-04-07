<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Contacts
{
    public function __construct(private readonly HttpClient $http) {}

    public function create(array $data): mixed
    {
        return $this->http->post('/contacts', $data);
    }

    public function list(?array $query = null): mixed
    {
        return $this->http->get('/contacts', $query);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/contacts/{$id}");
    }

    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/contacts/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/contacts/{$id}");
    }

    public function import(array $data): mixed
    {
        return $this->http->post('/contacts/import', $data);
    }

    public function getTags(string $id): mixed
    {
        return $this->http->get("/contacts/{$id}/tags");
    }

    public function addTag(string $id, string $tag): mixed
    {
        return $this->http->post("/contacts/{$id}/tags", compact('tag'));
    }

    public function removeTag(string $id, string $tag): mixed
    {
        return $this->http->delete("/contacts/{$id}/tags/" . urlencode($tag));
    }

    public function optIn(string $id): mixed
    {
        return $this->http->post("/contacts/{$id}/opt-in");
    }

    public function optOut(string $id): mixed
    {
        return $this->http->post("/contacts/{$id}/opt-out");
    }
}
