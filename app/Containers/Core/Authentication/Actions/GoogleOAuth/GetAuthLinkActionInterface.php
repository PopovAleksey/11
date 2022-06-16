<?php

namespace App\Containers\Core\Authentication\Actions\GoogleOAuth;

interface GetAuthLinkActionInterface
{
    public function run(): string;
}