<?php

namespace App\Containers\Constructor\Page\Tasks\Field;

use App\Ship\Parents\Dto\PageFieldDto;

interface UpdateFieldTaskInterface
{
    public function run(PageFieldDto $data): PageFieldDto;
}