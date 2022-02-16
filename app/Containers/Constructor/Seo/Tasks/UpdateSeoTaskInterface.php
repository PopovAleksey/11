<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;

interface UpdateSeoTaskInterface
{
    public function run(SeoDto $data): SeoDto;
}