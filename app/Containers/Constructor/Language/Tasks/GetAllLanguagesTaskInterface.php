<?php

namespace App\Containers\Constructor\Language\Tasks;

use Illuminate\Support\Collection;

interface GetAllLanguagesTaskInterface
{
    public function run(): Collection;
}
