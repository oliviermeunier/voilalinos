<?php

namespace App\User\App\Command;

class DeleteUserCommand
{
    public function __construct(
        public string $id
    ){
    }
}