<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Channels
{
    public function __construct(private readonly HttpClient $http) {}

    public function create(array $data): mixed
    {
        return $this->http->post('/channels', $data);
    }

    public function list(): mixed
    {
        return $this->http->get('/channels');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/channels/{$id}");
    }

    public function connect(string $id, ?array $data = null): mixed
    {
        return $this->http->post("/channels/{$id}/connect", $data);
    }

    public function disconnect(string $id): mixed
    {
        return $this->http->post("/channels/{$id}/disconnect");
    }

    public function status(string $id): mixed
    {
        return $this->http->get("/channels/{$id}/status");
    }

    /**
     * Update channel settings (name, caps, risk engine). Requires JWT session (not API key).
     *
     * @param array{name?: string, dailySendCap?: int, burstLimitPerMinute?: int, riskEngineEnabled?: bool} $data
     */
    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/channels/{$id}", $data);
    }

    /** Ask the gateway to reconnect the WhatsApp session. Requires JWT session (not API key). */
    public function reconnect(string $id): mixed
    {
        return $this->http->post("/channels/{$id}/reconnect");
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/channels/{$id}");
    }
}
