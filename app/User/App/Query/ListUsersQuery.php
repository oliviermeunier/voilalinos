<?php

namespace App\User\App\Query;

class ListUsersQuery
{
    public function __construct(
        public int $page,
        public int $perPage,
    ){
    }
}