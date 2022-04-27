<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Ship\Parents\Dto\PageDto;

interface CreatePageActionInterface
{
    public function run(PageDto $data): int;
}