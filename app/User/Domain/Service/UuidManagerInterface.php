<?php

namespace App\User\Domain\Service;

interface UuidManagerInterface
{
    public function generate(): string;
    public function isValid(?string $id): bool;
}