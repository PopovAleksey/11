<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Ship\Parents\Dto\SeoDto;

interface UpdateSeoTaskInterface
{
    public function run(SeoDto $data): SeoDto;
}