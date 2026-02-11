<?php declare (strict_types = 1);

namespace App;

class AdminUser extends UserBase
{
    public const ROLE_ADMIN = 'admin';

    public function __construct(string $name, string $email)
    {
        parent::__construct($name, $email);
        $this->role = self::ROLE_ADMIN;
    }

    public function deleteUser(Userbase $user): void
    {
        echo "Admin {$this->name} is deleting user: {$user->getName()}\n";
    }
}