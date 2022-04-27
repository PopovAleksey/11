<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Parents\Dto\ContentDto;

interface CreateContentTaskInterface
{
    public function run(ContentDto $data): int;
}