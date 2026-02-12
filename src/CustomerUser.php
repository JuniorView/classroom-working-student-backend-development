<?php

namespace App;

class CustomerUser extends UserBase
{
    public const ROLE_CUSTOMER = 'CUSTOMER';

    public function __construct(string $name, string $email)
    {
        parent::__construct($name, $email);
        $this->role = self::ROLE_CUSTOMER;
    }
}