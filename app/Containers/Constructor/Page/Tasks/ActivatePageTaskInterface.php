<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Parents\Dto\PageDto;

interface ActivatePageTaskInterface
{
    public function run(PageDto $data): PageDto;
}