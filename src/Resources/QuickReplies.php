<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Canned agent replies (shortcuts).
 *
 * @see https://tabi.africa/api-docs
 */
class QuickReplies
{
    public function __construct(private readonly HttpClient $http) {}

    public function list(): mixed
    {
        return $this->http->get('/quick-replies');
    }

    /**
     * @param array{
     *   title: string,
     *   content: string,
     *   shortcut?: string,
     *   category?: string
     * } $data
     */
    public function create(array $data): mixed
    {
        return $this->http->post('/quick-replies', $data);
    }

    /**
     * @param array{
     *   title?: string,
     *   content?: string,
     *   shortcut?: string,
     *   category?: string,
     *   isActive?: bool
     * } $data
     */
    public function update(string $id, array $data): mixed
    {
        return $this->http->patch("/quick-replies/{$id}", $data);
    }

    public function delete(string $id): mixed
    {
        return $this->http->delete("/quick-replies/{$id}");
    }
}
