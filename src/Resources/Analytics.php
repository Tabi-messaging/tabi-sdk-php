<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Analytics
{
    public function __construct(private readonly HttpClient $http) {}

    public function dashboard(?array $query = null): mixed
    {
        return $this->http->get('/analytics/dashboard', $query);
    }

    public function channels(?array $query = null): mixed
    {
        return $this->http->get('/analytics/channels', $query);
    }

    public function conversations(?array $query = null): mixed
    {
        return $this->http->get('/analytics/conversations', $query);
    }
}
