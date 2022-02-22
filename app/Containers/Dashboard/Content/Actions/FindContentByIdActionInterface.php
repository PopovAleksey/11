<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;

interface FindContentByIdActionInterface
{
    public function run(int $id): ContentDto;
}