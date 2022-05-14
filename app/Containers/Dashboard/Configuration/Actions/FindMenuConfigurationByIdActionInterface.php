<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use Illuminate\Support\Collection;

interface FindMenuConfigurationByIdActionInterface
{
    public function run(int $id): Collection;
}