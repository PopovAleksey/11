<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Ship\Parents\Dto\ContentDto;

interface UpdateContentActionInterface
{
    public function run(ContentDto $data): void;
}