<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Files
{
    public function __construct(private readonly HttpClient $http) {}

    public function list(): mixed
    {
        return $this->http->get('/files');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/files/{$id}");
    }

    public function getUrl(string $id): mixed
    {
        return $this->http->get("/files/{$id}/url");
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/files/{$id}");
    }
}
