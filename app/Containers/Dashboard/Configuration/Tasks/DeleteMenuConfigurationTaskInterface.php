<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

interface DeleteMenuConfigurationTaskInterface
{
    public function run(int $id): ?bool;
}