<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * WhatsApp channels — CRUD, connect, status, hosted OTP.
 *
 * @see https://tabi.africa/api-docs
 */
class Channels
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array{name: string, provider: string} $data `provider`: e.g. `messaging`, `whatsapp_cloud`, `sandbox`
     */
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

    /**
     * Start or continue channel connection (QR or pairing code flow).
     *
     * @param array{method?: 'qr'|'pairing_code', phone?: string}|null $data For `pairing_code`, `phone` (digits with country code, no +) is required
     */
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
     * Update channel settings. Requires JWT session (not an integrator API key alone).
     *
     * @param array{
     *   name?: string,
     *   dailySendCap?: int,
     *   burstLimitPerMinute?: int,
     *   riskEngineEnabled?: bool,
     *   settings?: array<string, mixed>
     * } $data
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

    /**
     * Hosted OTP: request code generation and WhatsApp delivery.
     * REST: `POST /channels/{id}/otp/send`
     *
     * @param array{phone: string} $data Recipient in E.164 or format accepted by the API
     */
    public function sendOtp(string $id, array $data): mixed
    {
        return $this->http->post("/channels/{$id}/otp/send", $data);
    }

    /**
     * Hosted OTP: verify a submitted code.
     * REST: `POST /channels/{id}/otp/verify`
     *
     * @param array{phone: string, code: string} $data
     */
    public function verifyOtp(string $id, array $data): mixed
    {
        return $this->http->post("/channels/{$id}/otp/verify", $data);
    }
}
