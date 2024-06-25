<?php

namespace App\User\Domain\ValueObjects;

use App\User\Domain\Service\UuidManagerInterface;

class UserId
{
    private string $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public static function generate(UuidManagerInterface $uuidManager): self
    {
        return new self($uuidManager->generate());
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(UserId $other): bool
    {
        return $this->id === (string) $other;
    }
}
