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

    // Demonstrate Magic Methode __toString
    echo "Created Users: \n";
    echo $alice . "\n";
    echo $bob . "\n";

    // Demonstrate array Functions and closures
    echo "\nFiltering for customers only: \n";
    $customers = $manager->getUsersByRole(CustomerUser::ROLE_CUSTOMER);
    foreach ($customers as $customer) {
        echo "- " . $customer->getName() . "\n";
    }

    // Demontrate static Property
    echo "\nTotal users created: " . AdminUser::getUserCounter() . "\n";

    // 6. Demonstrate Superglobals (Task 10)
    echo "\nSimulating user creation via \$_POST:\n";

    // Manually injecting data into the superglobal for demonstration purposes
    $_POST['name'] = 'Eve Superglobal';
    $_POST['email'] = 'eve@example.com';

    $superUser = $manager->createFromGlobals();

    if ($superUser) {
        echo "Successfully created user from \$_POST: " . $superUser->getName() . "\n";
    }
    //Demonstrate exeption Handling
    echo "\ntesting Exception handling with invalid email:\n";
    new CustomerUser('Bad User', 'not-an-email');


} catch (Exception $e) {
    echo "Caught Exception: " . $e->getMessage() . "\n";
}

echo "\n Demo completed successfully super.\n";