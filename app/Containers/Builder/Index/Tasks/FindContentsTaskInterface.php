<?php

namespace App\Containers\Builder\Index\Tasks;


use App\Ship\Parents\Dto\ContentDto;

interface FindContentsTaskInterface
{
    public function run(int $languageId, ?string $seoLink): ContentDto;
}