<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use Illuminate\Support\Collection;

interface GetAllMenuPossibleListTaskInterface
{
    public function run(): Collection;
}