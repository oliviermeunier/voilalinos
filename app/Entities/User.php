<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use Symfony\Component\Uid\Uuid;

class User extends Entity
{
    protected $attributes = [
        'id' => null,
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'phone' => null,
        'address' => null,
        'professional_status' => null,
        'last_login' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    protected $dates = ['created_at', 'updated_at', 'last_login'];

    public function __construct(array $data = null)
    {
        parent::__construct($data);

        $this->attributes['id'] = Uuid::v4()->toRfc4122();
    }
}
