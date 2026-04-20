<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Third-party integrations (provider + credentials + config).
 *
 * @see https://tabi.africa/api-docs
 */
class Integrations
{
    public function __construct(private readonly HttpClient $http) {}

    public function listProviders(): mixed
    {
        return $this->http->get('/integrations/providers');
    }

    /**
     * @param array{
     *   provider: string,
     *   credentials: array<string, mixed>,
     *   label?: string,
     *   config?: array<string, mixed>
     * } $data `provider` is the provider slug (e.g. from `listProviders()`)
     */
    public function create(array $data): mixed
    {
        return $this->http->post('/integrations', $data);
    }

    public function list(): mixed
    {
        return $this->http->get('/integrations');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/integrations/{$id}");
    }

    /**
     * @param array{label?: string, config?: array<string, mixed>, credentials?: array<string, mixed>} $data
     */
    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/integrations/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/integrations/{$id}");
    }

    public function test(string $id): mixed
    {
        return $this->http->post("/integrations/{$id}/test");
    }
}
