<?php

namespace App\Containers\Builder\Index\Actions;

use Illuminate\Support\Collection;

interface IndexBuilderActionInterface
{
    public function run(): Collection;
}