<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Workspace analytics aggregates.
 *
 * Current API routes do not document query parameters for these GETs; pass `null` or `[]`.
 *
 * @see https://tabi.africa/api-docs
 */
class Analytics
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * @param array<string, string>|null $query Reserved for future filters — currently unused by the API
     */
    public function dashboard(?array $query = null): mixed
    {
        return $this->http->get('/analytics/dashboard', $query);
    }

    /**
     * @param array<string, string>|null $query Reserved for future filters — currently unused by the API
     */
    public function channels(?array $query = null): mixed
    {
        return $this->http->get('/analytics/channels', $query);
    }

    /**
     * @param array<string, string>|null $query Reserved for future filters — currently unused by the API
     */
    public function conversations(?array $query = null): mixed
    {
        return $this->http->get('/analytics/conversations', $query);
    }
}
