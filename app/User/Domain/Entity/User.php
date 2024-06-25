<?php

namespace App\User\Domain\Entity;

use App\User\Domain\ValueObjects\UserId;

class User
{
    public function __construct(
        private UserId $id,
        private ?string $firstName = null,
        private ?string $lastName = null,
        private ?string $email = null,
        private ?string $phone = null,
        private ?string $address = null,
        private ?string $professionalStatus = null,
        private ?\DateTimeImmutable $lastLogin = null,
        private ?\DateTimeImmutable $createdAt = null,
        private ?\DateTimeImmutable $updatedAt = null,
    ){
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getProfessionalStatus(): string
    {
        return $this->professionalStatus;
    }

    public function setProfessionalStatus(string $professionalStatus): void
    {
        $this->professionalStatus = $professionalStatus;
    }

    public function getLastLogin(): ?\DateTimeImmutable
    {
        return $this->lastLogin;
    }

    public function setLastLogin(?\DateTimeImmutable $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}