<?php

namespace App\Containers\Dashboard\Content\Tasks;


use App\Ship\Parents\Dto\ContentDto;

interface UpdateContentSeoLinkTaskInterface
{
    public function run(ContentDto $data): bool;
}