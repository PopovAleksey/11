<?php

namespace App\Containers\Builder\Index\Tasks\Builder;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ThemeDto;

interface BuildPageTaskInterface
{
    public function run(ThemeDto $themeDto, ContentDto $contentDto): string;
}