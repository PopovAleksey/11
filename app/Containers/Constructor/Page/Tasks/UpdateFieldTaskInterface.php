<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;

interface UpdateFieldTaskInterface
{
    public function run(PageFieldDto $data): PageFieldDto;
}