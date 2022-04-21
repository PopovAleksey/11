<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;

interface UpdateContentActionInterface
{
    public function run(ContentDto $data): bool;
}