<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Ship\Parents\Dto\PageDto;

interface FindPageByIdActionInterface
{
    public function run(int $id, bool $withFields = false): PageDto;
}