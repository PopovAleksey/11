<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use Illuminate\Support\Collection;

interface UpdateMenuConfigurationTaskInterface
{
    public function run(Collection $data): bool;
}