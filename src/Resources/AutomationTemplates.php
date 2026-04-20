<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Automation template catalog (read-only list/detail).
 *
 * @see https://tabi.africa/api-docs
 */
class AutomationTemplates
{
    public function __construct(private readonly HttpClient $http) {}

    public function list(): mixed
    {
        return $this->http->get('/automation-templates');
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/automation-templates/{$id}");
    }
}
