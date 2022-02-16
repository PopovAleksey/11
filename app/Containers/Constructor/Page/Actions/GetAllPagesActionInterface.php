<?php

namespace App\Containers\Constructor\Page\Actions;

use Illuminate\Support\Collection;

interface GetAllPagesActionInterface
{
    public function run(bool $withFields = false): Collection;
}