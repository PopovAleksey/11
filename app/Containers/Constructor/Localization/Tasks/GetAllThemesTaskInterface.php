<?php

namespace App\Containers\Constructor\Localization\Tasks;

use Illuminate\Support\Collection;

interface GetAllThemesTaskInterface
{
    public function run(): Collection;
}
