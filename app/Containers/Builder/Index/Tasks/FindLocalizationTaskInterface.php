<?php

namespace App\Containers\Builder\Index\Tasks;

use Illuminate\Support\Collection;

interface FindLocalizationTaskInterface
{
    public function run(int $languageId, int $themeId, Collection $localizationPoints): Collection;
}