<?php

namespace App\Containers\Constructor\Localization\Tasks;

interface IsPointExistsTaskInterface
{
    public function run(string $point, ?int $themeId): bool;
}