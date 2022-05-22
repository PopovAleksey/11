<?php

namespace App\Containers\Constructor\Page\Tasks\Page;

use App\Ship\Parents\Dto\PageDto;

interface CreatePageTaskInterface
{
    public function run(PageDto $data): int;
}