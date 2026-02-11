<?php declare (strict_types = 1);

namespace App\Interfaces;

/**
 *Interface for entities that can have their password reset
 */
interface Resettable
{
    public function resetPassword(string $newPassword): void ;
}

