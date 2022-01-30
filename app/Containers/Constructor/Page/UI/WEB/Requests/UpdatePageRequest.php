<?php

namespace App\Containers\Constructor\Page\UI\WEB\Requests;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Ship\Parents\Requests\Request;

class UpdatePageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'                 => ['string', 'min:1', 'max:100'],
            'active'               => ['boolean'],
            'fields'               => ['array'],
            'fields.*.name'        => ['required', 'string', 'min:1', 'max:100'],
            'fields.*.type'        => ['required', 'string', 'in:input,textarea,select,select-multiple,radio,checkbox,file'],
            'fields.*.placeholder' => ['string', 'max:100'],
            'fields.*.mask'        => ['string', 'max:100'],
            'fields.*.values'      => ['array'],
            'fields.*.active'      => ['boolean'],
        ];
    }

    public function mapped(): PageDto
    {
        $fields = collect($this->get('fields', []))
            ->map(static function ($field) {

            })->toArray();

        return (new PageDto())
            ->setName($this->get('name'))
            ->setActive($this->get('active'))
            ->setFields($fields);
    }
}
