<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Parents\Dto\PageDto;

interface FindPageByIdTaskInterface
{
    public function run(int $id, bool $withFields = false): PageDto;
}