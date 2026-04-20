<?php

declare(strict_types=1);

namespace Tabi\SDK\Resources;

use Tabi\SDK\HttpClient;

/**
 * Outbound send (`/channels/.../send`) and conversation messaging helpers.
 *
 * @see https://tabi.africa/api-docs
 */
class Messages
{
    public function __construct(private readonly HttpClient $http) {}

    /**
     * Queue a message to a phone number on the channel (`DirectSendDto`).
     *
     * @param array{
     *   to: string,
     *   content: string,
     *   contactName?: string,
     *   channelId?: string,
     *   messageType?: string,
     *   mediaUrl?: string,
     *   messageClass?: 'transactional'|'conversational_reply'|'triggered_followup'|'broadcast'|string
     * } $data Non-text types require `mediaUrl`. If `channelId` is set, it must match `$channelId`.
     */
    public function send(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/send", $data);
    }

    public function get(string $id): mixed
    {
        return $this->http->get("/messages/{$id}");
    }

    /**
     * @param array{
     *   page?: int,
     *   limit?: int,
     *   search?: string,
     *   sortBy?: string,
     *   sortOrder?: 'ASC'|'DESC'
     * }|null $query Pagination + `MessageFilterDto` fields
     */
    public function listByConversation(string $conversationId, ?array $query = null): mixed
    {
        return $this->http->get("/conversations/{$conversationId}/messages", $query);
    }

    /**
     * Agent reply in a conversation (`SendMessageDto`).
     *
     * @param array{
     *   content: string,
     *   messageType?: string,
     *   mediaUrl?: string
     * } $data
     */
    public function reply(string $conversationId, array $data): mixed
    {
        return $this->http->post("/conversations/{$conversationId}/messages", $data);
    }

    /**
     * @param array{to: string, stickerUrl: string} $data
     */
    public function sendSticker(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/sticker", $data);
    }

    /**
     * @param array{to: string, contactName: string, contactPhone: string} $data
     */
    public function sendContact(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/contact", $data);
    }

    /**
     * @param array{to: string, latitude: string, longitude: string} $data Coordinates as strings per API
     */
    public function sendLocation(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/location", $data);
    }

    /**
     * @param array{to: string, question: string, options: string[], maxAnswer: int} $data
     */
    public function sendPoll(string $channelId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/poll", $data);
    }

    /**
     * @param array{to: string, emoji: string} $data `messageId` is the provider/vendor message id
     */
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

    /**
     * @param array{to: string, text: string} $data
     */
    public function edit(string $channelId, string $messageId, array $data): mixed
    {
        return $this->http->post("/channels/{$channelId}/messaging/messages/{$messageId}/edit", $data);
    }

    public function downloadMedia(string $channelId, string $messageId): mixed
    {
        return $this->http->get("/channels/{$channelId}/messaging/messages/{$messageId}/media");
    }
}
