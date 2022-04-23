<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use Illuminate\Support\Collection;

interface GetAllConfigurationsActionInterface
{
    public function run(): Collection;
}