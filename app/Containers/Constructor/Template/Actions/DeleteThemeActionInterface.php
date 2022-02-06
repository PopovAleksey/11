<?php

namespace App\Containers\Constructor\Template\Actions;

interface DeleteThemeActionInterface
{
    public function run(int $id): bool;
}