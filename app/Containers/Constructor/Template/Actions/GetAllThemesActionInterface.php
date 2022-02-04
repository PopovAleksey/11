<?php

namespace App\Containers\Constructor\Template\Actions;

use Illuminate\Support\Collection;

interface GetAllThemesActionInterface
{
    public function run(): Collection;
}