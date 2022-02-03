<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Ship\Parents\Requests\Request;

class GetAllTemplatesRequest extends Request
{
    public function rules(): array
    {
        return [
            // 'id' => 'required'
        ];
    }

    public function mapped(): TemplateDto
    {
        return (new TemplateDto());
    }
}
