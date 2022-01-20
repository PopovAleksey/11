<?php

namespace App\Containers\Core\Authentication\Tasks;

interface LoginTaskInterface
{
    public function run(string $email, string $password, bool $remember = false): bool;
}