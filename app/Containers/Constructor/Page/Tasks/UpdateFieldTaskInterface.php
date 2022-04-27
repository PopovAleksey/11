<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Parents\Dto\PageFieldDto;

interface UpdateFieldTaskInterface
{
    public function run(PageFieldDto $data): PageFieldDto;
}