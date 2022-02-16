<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;

interface UpdateSeoActionInterface
{
    public function run(SeoDto $data): SeoDto;
}