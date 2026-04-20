<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Auth and session endpoints (JWT). Request body shapes match `RegisterDto`, `LoginDto`, etc. in the public OpenAPI document.
 *
 * @see https://tabi.africa/api-docs
 */
class Auth
{
    public function __construct(private readonly HttpClient $http) {}

    public function login(string $email, string $password): mixed
    {
        return $this->http->post('/auth/login', compact('email', 'password'));
    }

    /**
     * @param array{
     *   email: string,
     *   password: string,
     *   firstName?: string,
     *   lastName?: string,
     *   workspaceName?: string,
     *   inviteToken?: string
     * } $data Register payload. When `inviteToken` is set, `workspaceName` is omitted (join existing workspace).
     */
    public function register(array $data): mixed
    {
        return $this->http->post('/auth/register', $data);
    }

    /**
     * @param string $refreshToken Refresh token from login/refresh response
     */
    public function refresh(string $refreshToken): mixed
    {
        return $this->http->post('/auth/refresh', compact('refreshToken'));
    }

    public function logout(): mixed
    {
        return $this->http->post('/auth/logout');
    }

    /** Current user and workspace context (Bearer JWT). */
    public function me(): mixed
    {
        return $this->http->get('/auth/me');
    }

    /**
     * Public preview for a team invite link. Query: `GET /auth/invite-preview?token=…`
     *
     * @param string $token Invite token from the email link
     */
    public function invitePreview(string $token): mixed
    {
        return $this->http->get('/auth/invite-preview', compact('token'));
    }
}
