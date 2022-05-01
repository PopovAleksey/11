<?php

namespace App\Containers\Builder\Index\Tasks;


use App\Ship\Parents\Dto\ThemeDto;

interface FindTemplatesTaskInterface
{
    public function run(int $languageId): ThemeDto;
}