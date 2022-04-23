<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use Illuminate\Support\Collection;

interface GetAllConfigurationTaskInterface
{
    public function run(): Collection;
}