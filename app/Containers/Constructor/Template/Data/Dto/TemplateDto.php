<?php

namespace App\Containers\Constructor\Template\Data\Dto;

use Illuminate\Support\Carbon;
use PopovAleksey\Mapper\Mapper;

class TemplateDto extends Mapper
{
    private ?int $id = null;
    private ?string $type = null;
    private ?int $themeId = null;
    private ?int $pageId = null;
    private ?int $languageId = null;
    private ?string $html = null;
    private ?Carbon $createAt  = null;
    private ?Carbon $updateAt  = null;
}