<?php

namespace App\Containers\Constructor\Template\Actions;

use Illuminate\Support\Collection;

interface GetListBaseTemplatesActionInterface
{
    public function run(int $themeId, int $languageId = null): Collection;
}