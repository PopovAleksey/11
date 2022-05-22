<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Parents\Dto\ContentDto;

interface UpdateContentTaskInterface
{
    public function run(ContentDto $contentDto): void;
}