<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;
use App\User\Domain\ValueObjects\UserId;

interface UserRepositoryInterface
{
    public function find(UserId $id): ?User;
    public function findAll(?int $offset = null, ?int $limit = null): array;
    public function countAll(): int;
    public function insert(User $user): void;
    public function update(User $user): void;
    public function delete(User $user): void;
    public function removeInactiveUsers(\DateTime $threshold): int;
}