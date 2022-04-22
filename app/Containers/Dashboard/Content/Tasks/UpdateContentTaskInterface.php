<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;

interface UpdateContentTaskInterface
{
    public function run(ContentDto $contentDto): bool;
}