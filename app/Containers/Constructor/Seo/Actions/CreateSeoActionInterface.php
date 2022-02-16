<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;

interface CreateSeoActionInterface
{
    public function run(SeoDto $data): bool;
}