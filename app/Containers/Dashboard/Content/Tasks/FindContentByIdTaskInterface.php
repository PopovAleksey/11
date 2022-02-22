<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;

interface FindContentByIdTaskInterface
{
    public function run(int $id): ContentDto;
}