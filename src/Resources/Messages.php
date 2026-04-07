<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

class Messages
{
    public function __construct(private readonly HttpClient $http) {}

    public function send(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/send", $data);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/messages/{$id}");
    }

    public function listByConversation(string $conversationId, ?array $query = null): mixed
    {
        return $this->http->get("/conversations/{$conversationId}/messages", $query);
    }

    public function reply(string $conversationId, array $data): mixed
    {
        return $this->http->post("/conversations/{$conversationId}/messages", $data);
    }

    public function sendSticker(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/sticker", $data);
    }

    public function sendContact(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/contact", $data);
    }

    public function sendLocation(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/location", $data);
    }

    public function sendPoll(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/poll", $data);
    }

    public function react(string $channelId, string $messageId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/messages/{$messageId}/reaction", $data);
    }

    public function markRead(string $channelId, string $messageId): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/messages/{$messageId}/mark-read");
    }

    public function revoke(string $channelId, string $messageId): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/messages/{$messageId}/revoke");
    }

    public function edit(string $channelId, string $messageId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/messages/{$messageId}/edit", $data);
    }

    public function downloadMedia(string $channelId, string $messageId): mixed
    {
        return $this->http->get("/channels/{$channelId}/messaging/messages/{$messageId}/media");
    }
}
