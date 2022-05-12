<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use Illuminate\Support\Collection;

interface GetAllMenuTemplateTaskInterface
{
    public function run(): Collection;
}