<?php

namespace App\User\UI\View;

use App\User\Domain\Entity\User;

class UserViewFactory
{
    public function getSingleView(User $user): array
    {
        return [
            'id' => (string) $user->getId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'address' => $user->getAddress(),
            'professionalStatus' => $user->getProfessionalStatus(),
            'lastLogin' => $user->getLastLogin() ? $user->getLastLogin()->format('Y-m-d H:i:s') : null,
        ];
    }

    public function getListView(array $users, int $count, int $perPage, int $page): array
    {
        return [
            'users' => array_map([$this, 'getSingleView'], $users),
            'pager' => [
                'currentPage' => $page,
                'totalPages' => ceil($count / $perPage),
                'totalUsers' => $count,
                'perPage' => $perPage,
            ]
        ];
    }
}