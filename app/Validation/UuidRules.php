<?php

namespace App\Validation;

use Symfony\Component\Uid\Uuid;

class UuidRules
{
    /**
     * Validate a UUID v4
     *
     * @param string $str
     * @return bool
     */
    public function isValidUuidV4(?string $id): bool
    {
        return null === $id || Uuid::isValid($id);
    }
}