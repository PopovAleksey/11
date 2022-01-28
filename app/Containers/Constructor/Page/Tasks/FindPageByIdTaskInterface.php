<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;

interface FindPageByIdTaskInterface
{
    public function run(int $id): PageDto;
}