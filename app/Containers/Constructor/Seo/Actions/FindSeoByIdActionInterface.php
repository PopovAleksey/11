<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;

interface FindSeoByIdActionInterface
{
    public function run(int $id): SeoDto;
}