<?php

namespace App\Containers\Constructor\Template\Tasks;

interface DeleteThemeTaskInterface
{
    public function run(int $id): ?bool;
}