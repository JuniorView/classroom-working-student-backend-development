<?php declare(strict_types=1);

namespace App\Traits;
/*
 * Trait to provide shared login functionality*/
trait CanLogin {
    private bool $isLoggedIn = false;

    public function login(): void
    {
        $this->isLoggedIn = true;
        echo "User logged in successfully. \n";
    }
    public function isLoggedIn(): bool
    {
        return $this->isLoggedIn;
    }
}
