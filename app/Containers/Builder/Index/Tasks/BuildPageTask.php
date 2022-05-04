<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class BuildPageTask extends Task implements BuildPageTaskInterface
{
    public function run(ThemeDto $themeDto, ContentDto $contentDto, Collection $menuList): string
    {
        dump($themeDto, $contentDto, $menuList);
        return '<html lang="us"><body style="background-color: #6d6d6d"></body></html>';
    }
}
