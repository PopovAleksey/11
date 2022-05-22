<?php

namespace App\Containers\Constructor\Page\Tasks\Page;

use App\Ship\Parents\Dto\PageDto;

interface FindPageByIdTaskInterface
{
    public function run(int $id, bool $withFields = false): PageDto;
}