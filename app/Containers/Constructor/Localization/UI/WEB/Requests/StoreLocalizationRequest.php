<?php

namespace App\Containers\Constructor\Localization\UI\WEB\Requests;

use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\LocalizationValueDto;
use App\Ship\Parents\Requests\Request;

class StoreLocalizationRequest extends Request
{
    public function rules(): array
    {
        return [
            'point'                => ['required', 'string'],
            'theme_id'             => ['integer', 'nullable'],
            'values'               => ['required', 'array'],
            'values.*.language_id' => ['required', 'integer'],
            'values.*.value'       => ['required', 'string'],
        ];
    }

    public function mapped(): LocalizationDto
    {
        $data = $this->validated();

        $values = collect(data_get($data, 'values'))
            ->map(static function ($value) {
                return (new LocalizationValueDto())
                    ->setLanguageId(data_get($value, 'language_id'))
                    ->setValue(data_get($value, 'value'));
            });

        return (new LocalizationDto())
            ->setPoint(data_get($data, 'point'))
            ->setThemeId(data_get($data, 'theme_id'))
            ->setValues($values);
    }
}
