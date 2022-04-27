<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Parents\Dto\ContentDto;

interface FindContentByIdTaskInterface
{
    public function run(int $id): ContentDto;
}