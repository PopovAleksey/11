<?php

namespace App\Containers\Constructor\Localization\Tasks;

use Illuminate\Support\Collection;

interface GetAllLanguagesTaskInterface
{
    public function run(): Collection;
}
