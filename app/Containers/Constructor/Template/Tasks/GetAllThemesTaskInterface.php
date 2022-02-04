<?php

namespace App\Containers\Constructor\Template\Tasks;

use Illuminate\Support\Collection;

interface GetAllThemesTaskInterface
{
    public function run(): Collection;
}