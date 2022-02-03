<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;

interface ActivatePageTaskInterface
{
    public function run(PageDto $data): PageDto;
}