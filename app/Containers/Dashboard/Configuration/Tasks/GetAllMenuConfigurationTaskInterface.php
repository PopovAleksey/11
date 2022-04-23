<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use Illuminate\Support\Collection;

interface GetAllMenuConfigurationTaskInterface
{
    public function run(): Collection;
}