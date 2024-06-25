<?php

namespace App\User\Domain\Service;

use App\User\App\Command\CreateUserCommand;
use App\User\App\Command\DeleteUserCommand;
use App\User\App\Command\UpdateUserCommand;
use App\User\App\Query\ListUsersQuery;
use App\User\Domain\Service\UuidManagerInterface;
use App\User\Domain\Entity\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObjects\UserId;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserService
{
    private UserRepositoryInterface $userRepository;
    private UuidManagerInterface $uuidManager;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UuidManagerInterface $uuidManager,
    )
    {
        $this->userRepository = $userRepository;
        $this->uuidManager = $uuidManager;
    }

    public function listUsers(ListUsersQuery $query): array
    {
        $offset = ($query->page - 1) * $query->perPage;
        return $this->userRepository->findAll($offset, $query->perPage);
    }

    public function countUsers(): int
    {
        return $this->userRepository->countAll();
    }

    public function createUser(CreateUserCommand $command): User
    {
        $user = new User(
            UserId::generate($this->uuidManager),
            $command->firstName,
            $command->lastName,
            $command->email,
            $command->phone,
            $command->address,
            $command->professionalStatus,
            createdAt: new \DateTimeImmutable(),
            updatedAt: new \DateTimeImmutable(),
        );

        $this->userRepository->insert($user);

        return $user;
    }

    public function getUserById(string $id): ?User
    {
        return $this->userRepository->find(UserId::fromString($id));
    }

    public function updateUser(UpdateUserCommand $command): ?User
    {
        $user = $this->userRepository->find(UserId::fromString($command->id));
        if ($user === null) {
            return null;
        }

        $user->setFirstName($command->firstName);
        $user->setLastName($command->lastName);
        $user->setEmail($command->email);
        $user->setPhone($command->phone);
        $user->setAddress($command->address);
        $user->setProfessionalStatus($command->professionalStatus);
        $user->setUpdatedAt(new \DateTimeImmutable());

        $this->userRepository->update($user);

        return $user;
    }

    public function deleteUser(DeleteUserCommand $command): void
    {
        $user = $this->userRepository->find(UserId::fromString($command->id));
        if ($user === null) {
            throw new PageNotFoundException(sprintf('User [Id:%s] not found', $command->id));
        }

        $this->userRepository->delete($user);
    }

    public function removeInactiveUsers(int $months): int
    {
        $threshold = new \DateTime();
        $threshold->modify("-{$months} months");

        return $this->userRepository->removeInactiveUsers($threshold);
    }
}
