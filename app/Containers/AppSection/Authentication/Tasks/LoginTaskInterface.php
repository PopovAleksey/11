<?php

namespace App\Containers\AppSection\Authentication\Tasks;

interface LoginTaskInterface
{
    public function run(string $email, string $password, bool $remember = false): bool;
}