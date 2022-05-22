<?php

namespace App\Containers\Constructor\Page\Tasks\Field;

use App\Ship\Parents\Dto\PageFieldDto;

interface FindFieldByIdTaskInterface
{
    public function run(int $id): PageFieldDto;
}