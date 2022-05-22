<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use Illuminate\Support\Collection;

interface GetAllMenuConfigurationActionInterface
{
    public function run(): Collection;
}