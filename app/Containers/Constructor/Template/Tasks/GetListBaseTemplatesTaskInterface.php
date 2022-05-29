<?php

namespace App\Containers\Constructor\Template\Tasks;

use Illuminate\Support\Collection;

interface GetListBaseTemplatesTaskInterface
{
    public function run(int $themeId, int $languageId = null): Collection;
}