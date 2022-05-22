<?php

namespace App\Containers\Constructor\Page\Tasks\Field;

use App\Ship\Parents\Dto\PageFieldDto;

interface CreateFieldTaskInterface
{
    public function run(PageFieldDto $data): int;
}