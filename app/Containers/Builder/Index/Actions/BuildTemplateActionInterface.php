<?php

namespace App\Containers\Builder\Index\Actions;

interface BuildTemplateActionInterface
{
    public function run(?string $language = null, ?string $seoLink = null): string;
}