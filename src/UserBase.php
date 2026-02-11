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

    // Private: used for magic __get/__set
    private array $dynamicData = [];

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

    // Basic setters
    public function setName(string $name): void {$this->name = $name;}
    public function setEmail(string $email): void {$this->email = $email;}

    /**
     * Magic __set: intercepted when writing to non-existing or inaccessible properties
     */
    public function __set(string $key, $value): void
    {
        echo "Magic Set: Saving '$value' into '$key'\n";
        $this->dynamicData[$key] = $value;
    }

    /**
     * Magic __get: intercepted when reading non-existing or inaccessible properties
     */
    public function __get(string $key)
    {
        echo "Magic Get: Accessing '$key'\n";
        return $this->dynamicData[$key] ?? $this->$key ?? null;
    }


    //implementation of Resettable Interface
    public function resetPassword(string $newPassword): void
    {
        //in real app , we could have hsched this passsword
        echo "Password for {$this->name} has bee reset \n";
    }
}