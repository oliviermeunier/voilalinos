<?php

namespace App\User\Infra\Repository;

use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObjects\UserId;
use CodeIgniter\Database\ConnectionInterface;

class MySQLUserRepository implements UserRepositoryInterface
{
    protected $db;
    protected $table = 'users';
    public function __construct(ConnectionInterface &$db)
    {
        $this->db = $db;
    }

    public function find(UserId $id): ?User
    {
        $user = $this->db->table($this->table)->where('id', (string) $id)->get()->getRowArray();
        if ($user === null) {
            return null;
        }

        return new User(
            UserId::fromString($user['id']),
            $user['first_name'],
            $user['last_name'],
            $user['email'],
            $user['phone'],
            $user['address'],
            $user['professional_status'],
            new \DateTimeImmutable($user['last_login']),
        );
    }

    public function findAll(?int $offset = null, ?int $limit = null): array
    {
        $builder = $this->db->table($this->table);

        if (!is_null($offset) && !is_null($limit)) {
            $builder->limit($limit, $offset);
        }

        $result = $builder->get()->getResultArray();

        return array_map(function ($row) {
            return new User(
                UserId::fromString($row['id']),
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['phone'],
                $row['address'],
                $row['professional_status'],
                new \DateTimeImmutable($row['last_login']),
            );
        }, $result);
    }

    public function countAll(): int
    {
        return $this->db->table($this->table)->countAllResults();
    }

    public function insert(User $user): void
    {
        $this->db->table($this->table)->insert([
            'id' => (string) $user->getId(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'address' => $user->getAddress(),
            'professional_status' => $user->getProfessionalStatus(),
            'last_login' => $user->getLastLogin() ? $user->getLastLogin()->format('Y-m-d H:i:s') : null,
            'created_at' => $user->getCreatedAt() ? $user->getCreatedAt()->format('Y-m-d H:i:s') : null,
            'updated_at' => $user->getUpdatedAt() ? $user->getUpdatedAt()->format('Y-m-d H:i:s') : null,
        ]);
    }

    public function update(User $user): void
    {
        $this->db->table($this->table)
            ->where('id', (string) $user->getId())
            ->update([
                'first_name' => $user->getFirstName(),
                'last_name' => $user->getLastName(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'address' => $user->getAddress(),
                'professional_status' => $user->getProfessionalStatus(),
                'last_login' => $user->getLastLogin() ? $user->getLastLogin()->format('Y-m-d H:i:s') : null,
                'updated_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
            ]);
    }

    public function delete(User $user): void
    {
        $this->db->table($this->table)->where('id', (string) $user->getId())->delete();
    }

    public function removeInactiveUsers(\DateTime $threshold): int
    {
        $builder = $this->db->table($this->table);
        $count = $builder
            ->where('last_login <', $threshold->format('Y-m-d H:i:s'))
            ->countAllResults(false);

        $builder
            ->where('last_login <', $threshold->format('Y-m-d H:i:s'))
            ->delete();

        return $count;
    }
}
