<?php

namespace App\Containers\Constructor\Template\Tasks;

use Illuminate\Support\Collection;

interface GetAllTemplatesTaskInterface
{
    public function run(): Collection;
}