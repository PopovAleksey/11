<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;

interface FindSeoByIdTaskInterface
{
    public function run(int $id): SeoDto;
}