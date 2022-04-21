<?php

namespace App\Containers\Dashboard\Content\UI\WEB\Requests;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Dto\ContentValueDto;
use App\Ship\Parents\Requests\Request;

class StoreContentRequest extends Request
{
    public function rules(): array
    {
        return [
            'pageId'              => ['required', 'integer'],
            'values'              => ['required', 'array'],
            'values.*.languageId' => ['required', 'integer'],
            'values.*.fieldId'    => ['required', 'integer'],
            'values.*.value'      => ['nullable', 'string'],
        ];
    }

    public function mapped(): ContentDto
    {
        $data   = $this->validated();
        $values = collect(data_get($data, 'values'))
            ->map(static function (array $value) {
                return (new ContentValueDto())
                    ->setLanguageId(data_get($value, 'languageId'))
                    ->setPageFieldId(data_get($value, 'fieldId'))
                    ->setValue(data_get($value, 'value'));
            });

        return (new ContentDto())
            ->setPageId(data_get($data, 'pageId'))
            ->setValues($values->toArray());
    }
}
