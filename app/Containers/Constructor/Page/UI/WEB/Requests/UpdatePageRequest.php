<?php

namespace App\Containers\Constructor\Page\UI\WEB\Requests;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Ship\Parents\Requests\Request;

class UpdatePageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'                 => ['string', 'min:1', 'max:100'],
            'active'               => ['boolean'],
            'fields'               => ['array'],
            'fields.*.id'          => ['nullable', 'integer'],
            'fields.*.name'        => ['required', 'string', 'min:1', 'max:100'],
            'fields.*.type'        => ['required', 'string', 'in:input,textarea,select,select-multiple,radio,checkbox,file'],
            'fields.*.placeholder' => ['nullable', 'string', 'max:100'],
            'fields.*.mask'        => ['nullable', 'string', 'max:100'],
            'fields.*.value'       => ['nullable', 'string'],
        ];
    }

    public function mapped(): PageDto
    {
        $fields = collect($this->get('fields', []))
            ->map(function ($field) {
                $values = data_get($field, 'value');
                $values = is_null($values) ? null : explode(';', $values);

                return (new PageFieldDto())
                    ->setId(data_get($field, 'id'))
                    ->setPageId($this->route('id'))
                    ->setName(data_get($field, 'name'))
                    ->setType(data_get($field, 'type'))
                    ->setPlaceholder(data_get($field, 'placeholder'))
                    ->setValues($values);
            })->toArray();

        return (new PageDto())
            ->setName($this->get('name'))
            ->setActive($this->get('active', true))
            ->setFields($fields);
    }
}
