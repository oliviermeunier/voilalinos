<?php

namespace App\User\Infra\Service;

use App\User\Domain\Service\UuidManagerInterface;
use Symfony\Component\Uid\Uuid;

class SymfonyUuidManager implements UuidManagerInterface
{
    public function generate(): string
    {
        return Uuid::v4()->toRfc4122();
    }

    public function isValid(?string $id): bool
    {
        return null === $id || Uuid::isValid($id);
    }
}
