<?php

namespace App\Containers\Builder\Index\Actions;

use Illuminate\Support\Collection;

interface GetContentCssOrJsActionInterface
{
    public function run(string $themeName, string $type, string $fileName): Collection;
}