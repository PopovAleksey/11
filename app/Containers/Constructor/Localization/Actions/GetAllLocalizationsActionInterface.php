<?php

namespace App\Containers\Constructor\Localization\Actions;

use Illuminate\Support\Collection;

interface GetAllLocalizationsActionInterface
{
    public function run(): Collection;
}