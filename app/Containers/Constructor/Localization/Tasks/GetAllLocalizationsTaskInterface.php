<?php

namespace App\Containers\Constructor\Localization\Tasks;

use Illuminate\Support\Collection;

interface GetAllLocalizationsTaskInterface
{
    public function run(): Collection;
}