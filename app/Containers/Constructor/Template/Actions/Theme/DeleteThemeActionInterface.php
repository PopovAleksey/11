<?php

namespace App\Containers\Constructor\Template\Actions\Theme;

interface DeleteThemeActionInterface
{
    public function run(int $id): bool;
}