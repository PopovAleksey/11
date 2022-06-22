<?php

namespace App\Containers\Constructor\Localization\Actions;

use Illuminate\Support\Collection;

interface GetAllLanguagesActionInterface
{
    public function run(): Collection;
}
