<?php

namespace App\Containers\Constructor\Seo\Tasks;

use Illuminate\Support\Collection;

interface GetAllSeosTaskInterface
{
    public function run(): Collection;
}