<?php

namespace App\Containers\Builder\Index\Tasks;


use App\Ship\Parents\Dto\ContentDto;

interface FindContentTaskInterface
{
    public function run(?string $seoLink): ContentDto;
}