<?php

namespace App\Containers\Constructor\Localization\Actions;

interface IsPointExistsActionInterface
{
    public function run(string $point, ?int $themeId = null): bool;
}