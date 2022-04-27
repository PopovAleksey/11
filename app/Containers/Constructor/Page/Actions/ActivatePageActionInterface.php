<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Ship\Parents\Dto\PageDto;

interface ActivatePageActionInterface
{
    public function run(PageDto $data): PageDto;
}