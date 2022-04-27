<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Ship\Parents\Dto\ContentDto;

interface CreateContentActionInterface
{
    public function run(ContentDto $data): int;
}