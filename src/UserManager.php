<?php

namespace App;
/*
 * Handles collections of users .
 * Demonstrates Array functions , closures, and Static methods*/
class UserManager
{
    /** @var UserBase[]
     * Numeric (indexed) Array :
     * Used here because we have a list of similar objects where the order
     * is important , but we don't need specific keys to identify them */
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

    public function getAllEmail(): array
    {
        return array_map(fn (UserBase $user) => $user->getEmail(), $this->users);
    }

    // Demonstrates array_map and Associative Arrays
    public function getUserMap(): array
    {
        /*
         * Associative Array :
         * Used here to map user names to their emails
         * Appropriate when you need to look up a value(email) using a specific unique key(name) .*/
        $map = [];
        foreach ($this->users as $user) {
            $map[$user->getName()] = $user->getEmail();
        }
        return $map;
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
            return new CustomerUser($cleanName, $email);
        }
        return null;
    }
}