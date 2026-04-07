<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Webhooks
{
    public function __construct(private readonly HttpClient $http) {}

    public function create(array $data): mixed
    {
        return $this->http->post('/webhooks', $data);
    }

    public function list(): mixed
    {
        return $this->http->get('/webhooks');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/webhooks/{$id}");
    }

    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/webhooks/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/webhooks/{$id}");
    }

    public function ping(string $id): mixed
    {
        return $this->http->post("/webhooks/{$id}/ping");
    }

    public function rotateSecret(string $id): mixed
    {
        return $this->http->post("/webhooks/{$id}/rotate-secret");
    }

    public function deliveryLogs(?array $query = null): mixed
    {
        return $this->http->get('/webhooks/delivery-logs', $query);
    }

    public function startTestCapture(): mixed
    {
        return $this->http->post('/webhooks/test-capture/start');
    }

    public function stopTestCapture(): mixed
    {
        return $this->http->post('/webhooks/test-capture/stop');
    }

    public function testCaptureStatus(): mixed
    {
        return $this->http->get('/webhooks/test-capture/status');
    }
}
