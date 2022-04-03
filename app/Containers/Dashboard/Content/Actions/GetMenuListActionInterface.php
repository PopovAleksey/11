<?php

namespace App\Containers\Dashboard\Content\Actions;

use Illuminate\Support\Collection;

interface GetMenuListActionInterface
{
    public function run(): Collection;
}