<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ContentValueRepositoryInterface
{
    public function getContentByLanguageAndSeoLink(int $languageId, ?string $seoLink = null): Collection;

    public function updateByCondition(array $data, array $condition): bool;
}