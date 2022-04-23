<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use Illuminate\Support\Collection;

interface GetAllMenuConfigurationActionInterface
{
    public function run(): Collection;
}