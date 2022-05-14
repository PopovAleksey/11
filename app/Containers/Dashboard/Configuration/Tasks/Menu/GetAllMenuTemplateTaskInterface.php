<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use Illuminate\Support\Collection;

interface GetAllMenuTemplateTaskInterface
{
    public function run(): Collection;
}