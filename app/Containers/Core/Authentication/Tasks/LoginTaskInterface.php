<?php

namespace App\Containers\Core\Authentication\Tasks;

use App\Containers\Core\Authentication\Data\Dto\LoginDto;

interface LoginTaskInterface
{
    public function run(LoginDto $loginDto): bool;
}