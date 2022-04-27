<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Ship\Parents\Dto\SeoDto;

interface CreateSeoTaskInterface
{
    public function run(SeoDto $data): int;
}