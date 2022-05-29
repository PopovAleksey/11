<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TemplateRepositoryInterface
{
    public function findByThemeAndLanguage(int $themeId, int $languageId, int $pageId): Collection;

    public function getIncludableItemsByTheme(int $themeId): Collection;

    public function getBaseTemplates(int $themeId, int $languageId = null): Collection;
}