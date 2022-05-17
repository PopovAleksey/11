<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

use Illuminate\Support\Collection;

interface GetAllThemesActionInterface
{
    public function run(): Collection;
}