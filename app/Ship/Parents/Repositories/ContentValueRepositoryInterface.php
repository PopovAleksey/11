<?php

namespace App\Ship\Parents\Repositories;


use Illuminate\Support\Collection;

interface ContentValueRepositoryInterface
{
    public function getContentValuesByLanguageAndSeoLink(int $languageId, ?string $seoLink = null): Collection;

    public function getContentValuesByLanguageAndIds(int $languageId, array|Collection $contentIds): Collection;

    public function updateByCondition(array $data, array $condition): bool;
}