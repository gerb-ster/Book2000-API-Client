<?php

declare(strict_types=1);

namespace Book2000\ApiClient\Request;

/**
 * Request body for POST /auth/login.
 *
 * Mirrors the "LoginRequest" schema from the OpenAPI definition.
 */
final class LoginRequest implements \JsonSerializable
{
    public function __construct(
        public readonly string $username,
        public readonly string $password,
    ) {
    }

    /**
     * @return array{username: string, password: string}
     */
    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
        ];
    }

    /**
     * @return array{username: string, password: string}
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
