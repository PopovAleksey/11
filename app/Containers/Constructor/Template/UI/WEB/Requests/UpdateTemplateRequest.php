<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Requests\Request;

class UpdateTemplateRequest extends Request
{
    public function rules(): array
    {
        return [
            'commonHtml'  => ['required', 'string', 'nullable'],
            'elementHtml' => ['string', 'nullable'],
            'previewHtml' => ['string', 'nullable'],
        ];
    }

    public function mapped(): TemplateDto
    {
        return (new TemplateDto())
            ->setCommonHtml(data_get($this->validated(), 'commonHtml'))
            ->setElementHtml(data_get($this->validated(), 'elementHtml'))
            ->setPreviewHtml(data_get($this->validated(), 'previewHtml'));
    }
}
