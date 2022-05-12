<?php

namespace App\Containers\Dashboard\Configuration\Actions;

interface DeleteMenuConfigurationActionInterface
{
    public function run(int $id): bool;
}