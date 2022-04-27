<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Requests;

use App\Containers\Constructor\Seo\Models\SeoInterface;
use App\Ship\Parents\Dto\SeoDto;
use App\Ship\Parents\Requests\Request;

class StoreSeoRequest extends Request
{
    public function rules(): array
    {
        $types = collect([
            SeoInterface::CAMEL_CASE,
            SeoInterface::PASCAL_CASE,
            SeoInterface::SNAKE_CASE,
            SeoInterface::KEBAB_CASE,
        ])->implode(',');

        return [
            'field_id'    => ['required', 'integer', 'exists:page_fields,id'],
            'language_id' => ['required', 'integer', 'exists:languages,id'],
            'case_type'   => ['required', 'string', 'in:' . $types],
        ];
    }

    public function mapped(): SeoDto
    {
        return (new SeoDto())
            ->setPageFieldId($this->get('field_id'))
            ->setLanguageId($this->get('language_id'))
            ->setCaseType($this->get('case_type'));
    }
}
