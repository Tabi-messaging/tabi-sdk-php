<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Webhook subscriptions, delivery logs, test capture.
 *
 * @see https://tabi.africa/api-docs
 */
class Webhooks
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array{url: string, events: string[], channelId?: string} $data `events` must be a non-empty list of event names
     */
    public function create(array $data): mixed
    {
        return $this->http->post('/webhooks', $data);
    }

    /**
     * @param array{channelId?: string}|null $query Optional filter for one channel
     */
    public function list(?array $query = null): mixed
    {
        return $this->http->get('/webhooks', $query);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/webhooks/{$id}");
    }

    /**
     * @param array{url?: string, events?: string[], isActive?: bool} $data
     */
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

    /**
     * @param array{channelId?: string, limit?: int}|null $query
     */
    public function deliveryLogs(?array $query = null): mixed
    {
        return $this->http->get('/webhooks/delivery-logs', $query);
    }

    /**
     * @param array{channelId: string} $data Channel to capture test webhooks for
     */
    public function startTestCapture(array $data): mixed
    {
        return $this->http->post('/webhooks/test-capture/start', $data);
    }

    /**
     * @param array{channelId: string} $data
     */
    public function stopTestCapture(array $data): mixed
    {
        return $this->http->post('/webhooks/test-capture/stop', $data);
    }

    /**
     * @param array{channelId: string} $query Required `channelId` query parameter
     */
    public function testCaptureStatus(array $query): mixed
    {
        return $this->http->get('/webhooks/test-capture/status', $query);
    }
}
