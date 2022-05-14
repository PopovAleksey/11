<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use Illuminate\Support\Collection;

interface GetAllMenuConfigurationTaskInterface
{
    public function run(Collection $menuTemplates): Collection;
}