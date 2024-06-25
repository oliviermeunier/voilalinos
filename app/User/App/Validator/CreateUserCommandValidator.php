<?php

namespace App\User\App\Validator;

use CodeIgniter\Validation\ValidationInterface;

// TODO renommer la classe
class CreateUserCommandValidator
{
    private ValidationInterface $validation;

    public function __construct(ValidationInterface $validation)
    {
        $this->validation = $validation;
    }

    public function validate(array $data, array $rules, array $messages = []): bool
    {
        $this->validation->setRules($rules, $messages);
        return $this->validation->run($data);
    }

    public function getErrors(): array
    {
        return $this->validation->getErrors();
    }
}