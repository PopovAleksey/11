<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Ship\Parents\Requests\Request;

class UpdateTemplateRequest extends Request
{
    public function rules(): array
    {
        return [
            'html' => ['required', 'string'],
        ];
    }

    public function mapped(): TemplateDto
    {
        return (new TemplateDto())->setHtml($this->get('html'));
    }
}
