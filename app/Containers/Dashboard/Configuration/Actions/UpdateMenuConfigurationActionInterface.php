<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use Illuminate\Support\Collection;

interface UpdateMenuConfigurationActionInterface
{
    public function run(Collection $data): bool;
}