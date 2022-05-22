<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

interface DeleteMenuConfigurationTaskInterface
{
    public function run(int $id): void;
}