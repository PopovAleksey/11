<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Data\Dto\PageDto;

interface UpdatePageActionInterface
{
    public function run(PageDto $data): PageDto;
}