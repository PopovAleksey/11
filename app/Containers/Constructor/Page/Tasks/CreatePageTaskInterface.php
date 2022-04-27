<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Parents\Dto\PageDto;

interface CreatePageTaskInterface
{
    public function run(PageDto $data): int;
}