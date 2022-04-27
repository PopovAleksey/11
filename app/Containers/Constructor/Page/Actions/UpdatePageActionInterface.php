<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Ship\Parents\Dto\PageDto;

interface UpdatePageActionInterface
{
    public function run(PageDto $data): PageDto;
}