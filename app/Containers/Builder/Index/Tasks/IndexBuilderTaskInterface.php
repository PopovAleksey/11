<?php

namespace App\Containers\Builder\Index\Tasks;

use Illuminate\Support\Collection;

interface IndexBuilderTaskInterface
{
    public function run(): Collection;
}