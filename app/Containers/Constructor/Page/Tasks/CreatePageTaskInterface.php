<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;

interface CreatePageTaskInterface
{
    public function run(PageDto $data): int;
}