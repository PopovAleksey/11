<?php

namespace App\Ship\Parents\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface ContentRepositoryInterface
{
    public function getFewContentIds(int $pageId, int $limit, string $byCriteria): Collection;
}