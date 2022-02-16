<?php

namespace App\Containers\Constructor\Seo\Actions;

use Illuminate\Support\Collection;

interface GetAllSeoActionInterface
{
    public function run(): Collection;
}