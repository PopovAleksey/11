<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\TemplateDto;
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
        return (new TemplateDto())->setCommonFilepath($this->get('html'));
    }
}
