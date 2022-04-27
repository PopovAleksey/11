<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Parents\Dto\PageFieldDto;

interface FindFieldByIdTaskInterface
{
    public function run(int $id): PageFieldDto;
}