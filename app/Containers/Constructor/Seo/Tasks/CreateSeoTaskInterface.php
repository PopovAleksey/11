<?php

namespace App\Containers\Constructor\Seo\Tasks;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;

interface CreateSeoTaskInterface
{
    public function run(SeoDto $data);
}