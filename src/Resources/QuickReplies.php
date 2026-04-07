<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class QuickReplies
{
    public function __construct(private readonly HttpClient $http) {}

    public function list(): mixed
    {
        return $this->http->get('/quick-replies');
    }

    public function create(array $data): mixed
    {
        return $this->http->post('/quick-replies', $data);
    }

    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/quick-replies/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/quick-replies/{$id}");
    }
}
