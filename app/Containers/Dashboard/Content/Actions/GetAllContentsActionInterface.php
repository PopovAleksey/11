<?php

namespace App\Containers\Dashboard\Content\Actions;

use Illuminate\Support\Collection;

interface GetAllContentsActionInterface
{
    public function run(): Collection;
}