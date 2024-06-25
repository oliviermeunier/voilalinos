<?php

namespace App\User\Infra\Validation;

class UserValidation
{
    public static $rules = [
        'id' => 'isValidUuidV4', // TODO changer de place le fichier UuidRules.php
        'firstName' => 'required|min_length[3]|max_length[100]',
        'lastName'  => 'required|min_length[3]|max_length[100]',
        'email'      => 'required|valid_email|is_unique[users.email,id,{id}]',
        'phone'      => 'required|min_length[10]|max_length[15]',
        'address'    => 'required|max_length[255]',
        'professionalStatus' => 'required|max_length[100]',
    ];

    public static $messages = [
        'firstName' => [
            'required' => 'The first name is required',
            'min_length' => 'The first name must be at least 3 characters long',
            'max_length' => 'The first name must not exceed 100 characters',
        ],
        'lastName' => [
            'required' => 'The last name is required',
            'min_length' => 'The last name must be at least 3 characters long',
            'max_length' => 'The last name must not exceed 100 characters',
        ],
        'email' => [
            'required' => 'The email is required',
            'valid_email' => 'The email is not valid',
            'is_unique' => 'The email already exists',
        ],
        'phone' => [
            'required' => 'The phone number is required',
            'min_length' => 'The phone number must be at least 10 characters long',
            'max_length' => 'The phone number must not exceed 15 characters',
        ],
        'address' => [
            'required' => 'The address is required',
            'max_length' => 'The address must not exceed 255 characters',
        ],
        'professionalStatus' => [
            'required' => 'The professional status is required',
            'max_length' => 'The professional status must not exceed 100 characters',
        ],
    ];
}
