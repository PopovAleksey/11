<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Ship\Parents\Dto\SeoDto;

interface CreateSeoActionInterface
{
    public function run(SeoDto $data): int;
}