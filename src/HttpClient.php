<?php

declare(strict_types=1);

namespace Tabi\SDK;

class HttpClient
{
    public function __construct(
        private readonly string $baseUrl,
        private readonly string $apiKey,
    ) {}

    /**
     * @param array<string, mixed>|null $body
     * @param array<string, string|int|bool>|null $query
     */
    public function request(string $method, string $path, ?array $body = null, ?array $query = null): mixed
    {
        $url = rtrim($this->baseUrl, '/') . $path;

        if ($query) {
            $filtered = array_filter($query, fn($v) => $v !== null);
            if ($filtered) {
                $url .= '?' . http_build_query($filtered);
            }
        }

        $ch = curl_init($url);
        if ($ch === false) {
            throw new TabiException('Failed to initialise cURL', 0);
        }

        $headers = [
            'Authorization: Bearer ' . $this->apiKey,
            'Accept: application/json',
        ];

        if ($body !== null) {
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        }

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);
        $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            throw new TabiException('cURL error: ' . $error, 0);
        }

        $json = json_decode((string) $response, true);

        if ($status >= 400) {
            $msg = 'Request failed (' . $status . ')';
            if (is_array($json)) {
                if (is_string($json['message'] ?? null)) {
                    $msg = $json['message'];
                } elseif (is_array($json['message'] ?? null)) {
                    $msg = implode(', ', $json['message']);
                }
            }
            throw new TabiException($msg, $status, $json);
        }

        if (is_array($json) && ($json['success'] ?? false) === true && array_key_exists('data', $json)) {
            return $json['data'];
        }

        return $json;
    }

    public function get(string $path, ?array $query = null): mixed
    {
        return $this->request('GET', $path, null, $query);
    }

    public function post(string $path, ?array $body = null): mixed
    {
        return $this->request('POST', $path, $body);
    }

    public function patch(string $path, ?array $body = null): mixed
    {
        return $this->request('PATCH', $path, $body);
    }

    public function delete(string $path): mixed
    {
        return $this->request('DELETE', $path);
    }
}
