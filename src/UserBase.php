<?php declare(strict_types=1);

namespace App; // I want this class to be reachable under App\...

use App\Interfaces\Resettable;
use App\Traits\CanLogin;
use Exception;

// Abstract base for all users.
abstract class UserBase implements Resettable
{
    use CanLogin;

    // Constants for roles
    public const ROLE_UNDEFINED = 'UNDEFINED';

    // Static property to count instances
    private static int $userCounter = 0;

    // Protected properties: accessible by child classes but not from outside
    protected string $name;
    protected string $email;
    protected string $role;

    public function __construct(string $name, string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }
        $this->name = $name;
        $this->email = $email;
        $this->role = self::ROLE_UNDEFINED;

        self::$userCounter++;
    }

    public function __toString(): string
    {
        return "[$this->role] {$this->name} ({$this->email})";
    }

    public static function getUserCounter(): int
    {
        return self::$userCounter;
    }

    //Basic getters
    public function getName(): string {return $this->name;}
    public function getEmail(): string {return $this->email;}

    //implementation of Resettable Interface
    public function resetPassword(string $newPassword): void
    {
        //in real app , we could have hsched this passsword
        echo "Password for {$this->name} has bee reset \n";
    }
}