<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Workspaces, members, invites.
 *
 * @see https://tabi.africa/api-docs
 */
class Workspaces
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array{name: string, slug?: string} $data
     */
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

    /**
     * @param array{name?: string, logoUrl?: string, automationsEnabled?: bool} $data
     */
    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/workspaces/{$id}", $data);
    }

    public function listMembers(string $id): mixed
    {
        return $this->http->get("/workspaces/{$id}/members");
    }

    /**
     * @param array{email: string, roleSlug?: string} $data `roleSlug` examples: `admin`, `agent`, `developer`
     */
    public function inviteMember(string $id, array $data): mixed
    {
        return $this->http->post("/workspaces/{$id}/members/invite", $data);
    }
}
