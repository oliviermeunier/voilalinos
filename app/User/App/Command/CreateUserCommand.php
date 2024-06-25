<?php

namespace App\User\App\Command;

class CreateUserCommand
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $phone,
        public string $address,
        public string $professionalStatus
    ){
    }
}