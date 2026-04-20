<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Contacts — CRUD, import, tags, consent.
 *
 * @see https://tabi.africa/api-docs
 */
class Contacts
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array{
     *   phone: string,
     *   name?: string,
     *   email?: string,
     *   source?: string,
     *   notes?: string,
     *   tags?: string[],
     *   metadata?: array<string, mixed>
     * } $data
     */
    public function create(array $data): mixed
    {
        return $this->http->post('/contacts', $data);
    }

    /**
     * @param array{
     *   page?: int,
     *   limit?: int,
     *   search?: string,
     *   sortBy?: string,
     *   sortOrder?: 'ASC'|'DESC'
     * }|null $query Pagination and search
     */
    public function list(?array $query = null): mixed
    {
        return $this->http->get('/contacts', $query);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/contacts/{$id}");
    }

    /**
     * @param array{
     *   name?: string,
     *   email?: string,
     *   notes?: string,
     *   metadata?: array<string, mixed>,
     *   doNotContact?: bool
     * } $data
     */
    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/contacts/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/contacts/{$id}");
    }

    /**
     * @param array{contacts: array<int, array<string, mixed>>} $data Each contact follows the same shape as `create()`
     */
    public function import(array $data): mixed
    {
        return $this->http->post('/contacts/import', $data);
    }

    public function getTags(string $id): mixed
    {
        return $this->http->get("/contacts/{$id}/tags");
    }

    /**
     * @param string $tag Tag label (API body field `tag`)
     */
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
