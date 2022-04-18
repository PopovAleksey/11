<?php

namespace App\Containers\Constructor\Language\Actions;

use Illuminate\Support\Collection;

interface GetAllLanguagesActionInterface
{
    public function run(bool $getOnlyActive = false): Collection;
}
