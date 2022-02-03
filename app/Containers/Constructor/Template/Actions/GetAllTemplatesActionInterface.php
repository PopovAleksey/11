<?php

namespace App\Containers\Constructor\Template\Actions;

use Illuminate\Support\Collection;

interface GetAllTemplatesActionInterface
{
    public function run(): Collection;
}