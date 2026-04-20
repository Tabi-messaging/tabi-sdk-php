<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * In-app notifications for the authenticated user.
 *
 * @see https://tabi.africa/api-docs
 */
class Notifications
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array{
     *   page?: int,
     *   limit?: int,
     *   search?: string,
     *   sortBy?: string,
     *   sortOrder?: 'ASC'|'DESC'
     * }|null $query
     */
    public function list(?array $query = null): mixed
    {
        return $this->http->get('/notifications', $query);
    }

    public function markRead(string $id): mixed
    {
        return $this->http->patch("/notifications/{$id}/read");
    }

    public function markAllRead(): mixed
    {
        return $this->http->post('/notifications/read-all');
    }

    public function unreadCount(): mixed
    {
        return $this->http->get('/notifications/unread-count');
    }
}
