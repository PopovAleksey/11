<?php

namespace App\Containers\Constructor\Page\Tasks\Page;

use App\Ship\Parents\Dto\PageDto;

interface ActivatePageTaskInterface
{
    public function run(PageDto $data): PageDto;
}