<?php

namespace App\Containers\Dashboard\Content\Actions;

use Illuminate\Support\Collection;

interface FindContentByIdActionInterface
{
    public function run(int $id): Collection;
}