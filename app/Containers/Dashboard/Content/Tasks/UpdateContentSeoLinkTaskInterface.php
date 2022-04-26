<?php

namespace App\Containers\Dashboard\Content\Tasks;


use App\Containers\Dashboard\Content\Data\Dto\ContentDto;

interface UpdateContentSeoLinkTaskInterface
{
    public function run(ContentDto $data): bool;
}