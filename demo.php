<?php declare(strict_types=1);

// Simple test/demo script - extend as you like!
use App\CustomerUser;
use App\UserManager;
use App\AdminUser;
require_once __DIR__ . '/vendor/autoload.php';

echo "PHP Basics Coding Challenge Demo\n";

try {
    $manager = new UserManager();

    // create Users
    $alice = new AdminUser('Alice Admin ', 'alice@exemple.com');
    $bob = new CustomerUser('Bob Customer', 'bob@exemple.com');
    $charlie = new CustomerUser('Charlie Customer', 'charlie@exemple.com');

    $manager->addUser($alice);
    $manager->addUser($bob);
    $manager->addUser($charlie);
    // 1. Demonstrate Trait Usage (Task 2: CanLogin)
    echo "\n--- Trait Demonstration (CanLogin) ---\n";

    echo "Is Bob logged in? " . ($bob->isLoggedIn() ? 'Yes' : 'No') . "\n";

    echo "Logging Bob in...\n";
    $bob->login(); // Diese Methode kommt direkt aus dem CanLogin Trait

    echo "Is Bob logged in now? " . ($bob->isLoggedIn() ? 'Yes' : 'No') . "\n";

    // 2. Demonstrate Magic Methode __toString
    echo "\n--- Created Users: \n";
    echo $alice . "\n";
    echo $bob . "\n";

    // 3. Demonstrate array Functions and closures
    echo "\n--- Filtering for customers only: \n";
    $customers = $manager->getUsersByRole(CustomerUser::ROLE_CUSTOMER);
    foreach ($customers as $customer) {
        echo "- " . $customer->getName() . "\n";
    }

    // 4. using array-map to get all email
    echo "\n--- All users's emails: \n";
    $emails = $manager->getAllEmail();
    foreach ($emails as $email) {
        echo "- " . $email . "\n";
    }
    // 5. Associative array example
    echo "\n--- Associative Array (Name => Email):\n";
    $emailMap = $manager->getUserMap();
    foreach ($emailMap as $name => $email) {
        echo " $name: $email\n";
    }

    // 6. Demontrate static Property
    echo "\n--- Total users created: " . AdminUser::getUserCounter() . "\n";

    // 7. Demonstrate Superglobals (Task 10)
    echo "\n--- Simulating user creation via \$_POST:\n";

    // Manually injecting data into the superglobal for demonstration purposes
    $_POST['name'] = 'Eve Superglobal';
    $_POST['email'] = 'eve@example.com';

    $superUser = $manager->createFromGlobals();

    if ($superUser) {
        echo "Successfully created user from \$_POST: " . $superUser->getName() . "\n";
    }

    // 8. Demonstrate Visibility & Getters/Setters
    echo "\n--- Visibility & Getters/Setters ---\n";
    $bob->setName('Robert'); // Using Public Setter
    echo "Updated Bob's name via Setter: New name is : " . $bob->getName() . "\n";

    // 10. Demonstrate Magic Methods (__get / __set)
    echo "\n--- Magic Methods Demonstration ---\n";

    // This property 'nickname' does not exist in the class, so it triggers __set
    $bob->nickname = "The Bobster";

    // This triggers __get
    echo "Bob's nickname (via __get): " . $bob->nickname . "\n";

    // Accessing 'role' via __get (since it is protected and not accessible directly)
    echo "Alice's role (via __get): " . $alice->role . "\n";

    //11. Demonstrate exeption Handling
    echo "\n--- testing Exception handling with invalid email:\n";
    new CustomerUser('Bad User', 'not-an-email');


} catch (Exception $e) {
    echo "Caught Exception: " . $e->getMessage() . "\n";
}

echo "\n Demo completed successfully super.\n";