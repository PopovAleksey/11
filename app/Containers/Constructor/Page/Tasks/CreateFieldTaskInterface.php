<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;

interface CreateFieldTaskInterface
{
    public function run(PageFieldDto $data): int;
}