<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

interface DeleteThemeTaskInterface
{
    public function run(int $id): void;
}