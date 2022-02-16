<?php

namespace App\Containers\Constructor\Seo\Tasks;

use Illuminate\Support\Collection;

interface GetAllSeoTaskInterface
{
    public function run(): Collection;
}