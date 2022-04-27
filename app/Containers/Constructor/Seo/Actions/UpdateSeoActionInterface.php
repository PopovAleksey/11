<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Ship\Parents\Dto\SeoDto;

interface UpdateSeoActionInterface
{
    public function run(SeoDto $data): SeoDto;
}