<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Data\Dto\PageDto;

interface FindPageByIdActionInterface
{
    public function run(int $id, bool $withFields = false): PageDto;
}