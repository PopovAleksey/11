<?php

namespace App\Containers\Core\Authentication\Tasks\GoogleOAuth;

use App\Containers\Core\Authentication\Data\Dto\LoginDto;

interface GetAuthCredentialsTaskInterface
{
    public function run(string $code): LoginDto;
}