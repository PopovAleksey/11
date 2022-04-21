<?php

namespace App\Containers\Dashboard\Content\UI\WEB\Requests;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Ship\Parents\Requests\Request;

class StoreContentRequest extends Request
{
    public function rules(): array
    {
        return [
            'pageId'              => ['required', 'integer'],
            'contentId'           => ['nullable', 'integer'],
            'values'              => ['required', 'array'],
            'values.*.languageId' => ['required', 'integer'],
            'values.*.fieldId'    => ['required', 'integer'],
            'values.*.value'      => ['nullable', 'string'],
        ];
    }

    public function mapped(): ContentDto
    {
        dd($this->validated());

        return (new ContentDto());
    }
}
