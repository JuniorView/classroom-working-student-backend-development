<?php declare(strict_types=1);

namespace App;

/*
 * A regular function to format names */
function formatUserName(UserBase $user): string
{
    return strtoupper($user->getName());
}
