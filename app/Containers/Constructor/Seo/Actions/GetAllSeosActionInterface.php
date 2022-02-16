<?php

namespace App\Containers\Constructor\Seo\Actions;

use Illuminate\Support\Collection;

interface GetAllSeosActionInterface
{
    public function run(): Collection;
}