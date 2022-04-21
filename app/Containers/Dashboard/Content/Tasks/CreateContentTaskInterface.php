<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;

interface CreateContentTaskInterface
{
    public function run(ContentDto $data): int;
}