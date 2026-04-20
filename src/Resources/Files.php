<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Uploaded media metadata and signed URLs.
 *
 * @see https://tabi.africa/api-docs
 */
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

    /** Response includes a time-limited download URL when applicable. */
    public function getUrl(string $id): mixed
    {
        return $this->http->get("/files/{$id}/url");
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/files/{$id}");
    }
}
