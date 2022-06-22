<?php

namespace App\Containers\Constructor\Localization\Actions;

use Illuminate\Support\Collection;

interface GetAllThemesActionInterface
{
    public function run(): Collection;
}