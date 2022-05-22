<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

interface DeleteMenuConfigurationActionInterface
{
    public function run(int $id): void;
}