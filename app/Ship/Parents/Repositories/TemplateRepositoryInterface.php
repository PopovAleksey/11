<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TemplateRepositoryInterface
{
    public function findByThemeAndLanguage(int $themeId, int $languageId): Collection;

    public function getIncludableItemsByTheme(int $themeId): Collection;
}