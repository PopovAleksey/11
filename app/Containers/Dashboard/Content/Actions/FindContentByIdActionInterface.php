<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Ship\Parents\Dto\ContentDto;

interface FindContentByIdActionInterface
{
    public function run(int $id): ContentDto;
}