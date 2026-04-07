<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class AutomationInstalls
{
    public function __construct(private readonly HttpClient $http) {}

    public function install(array $data): mixed
    {
        return $this->http->post('/automation-installs', $data);
    }

    public function list(): mixed
    {
        return $this->http->get('/automation-installs');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/automation-installs/{$id}");
    }

    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/automation-installs/{$id}", $data);
    }

    public function enable(string $id): mixed
    {
        return $this->http->post("/automation-installs/{$id}/enable");
    }

    public function disable(string $id): mixed
    {
        return $this->http->post("/automation-installs/{$id}/disable");
    }

    public function uninstall(string $id): mixed
    {
        return $this->http->delete("/automation-installs/{$id}");
    }
}
