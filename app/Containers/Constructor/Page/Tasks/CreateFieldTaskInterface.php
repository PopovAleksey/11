<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Parents\Dto\PageFieldDto;

interface CreateFieldTaskInterface
{
    public function run(PageFieldDto $data): int;
}