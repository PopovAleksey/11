<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;

interface FindFieldByIdTaskInterface
{
    public function run(int $id): PageFieldDto;
}