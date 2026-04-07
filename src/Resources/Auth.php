<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Auth
{
    public function __construct(private readonly HttpClient $http) {}

    public function login(string $email, string $password): mixed
    {
        return $this->http->post('/auth/login', compact('email', 'password'));
    }

    public function register(array $data): mixed
    {
        return $this->http->post('/auth/register', $data);
    }

    public function refresh(string $refreshToken): mixed
    {
        return $this->http->post('/auth/refresh', compact('refreshToken'));
    }

    public function logout(): mixed
    {
        return $this->http->post('/auth/logout');
    }

    public function me(): mixed
    {
        return $this->http->get('/auth/me');
    }

    public function invitePreview(string $token): mixed
    {
        return $this->http->get('/auth/invite-preview', compact('token'));
    }
}
