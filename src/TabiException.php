<?php

declare(strict_types=1);

namespace Tabi\SDK;

class TabiException extends \RuntimeException
{
    public function __construct(
        string $message,
        public readonly int $statusCode,
        public readonly mixed $body = null,
    ) {
        parent::__construct($message, $statusCode);
    }
}
