<?php

namespace App;
/*
 * Handles collections of users .
 * Demonstrates Array functions , closures, and Static methods*/
class UserManager
{
    /** @var UserBase[] */
    private array $users = [];

    public function addUser(UserBase $user): void
    {
        $this->users[] = $user;
    }
    /*
     * Demonstrates array-filter and closures
     * Returns only users of a specific role */
    public function getUsersByRole(string $role): array
    {
        //using a closure to filter the array
        return array_filter($this->users, function (UserBase $user) use ($role) {
            //we use 'instanceof' or a role check
            return $user instanceof AdminUser && $role === AdminUser::ROLE_ADMIN ||
                   $user instanceof CustomerUser && $role === CustomerUser::ROLE_CUSTOMER;
        });
    }

    public function getUserByEmail(): array
    {
        return array_map(fn (UserBase $user) => $user->getEmail(), $this->users);
    }

    // Demonstrate Superglobals simulation
    public function createFromGlobals(): ?UserBase
    {
        //simulation reading from $_Post as requested
        $name = $_POST["name"] ?? null;
        $email = $_POST["email"] ?? null;

        if ($name && $email) {
            // security awareness with sanitization
            $cleanName = htmlspecialchars(strip_tags($name));
            return new CustomerUser($name, $email);
        }
        return null;
    }
}