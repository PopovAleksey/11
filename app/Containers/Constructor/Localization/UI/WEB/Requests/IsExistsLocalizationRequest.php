<?php

namespace App\Containers\Constructor\Localization\UI\WEB\Requests;

use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Requests\Request;

class IsExistsLocalizationRequest extends Request
{
    public function rules(): array
    {
        return [
            'id'       => ['integer', 'nullable'],
            'point'    => ['required', 'string'],
            'theme_id' => ['integer', 'nullable'],
        ];
    }

    public function mapped(): LocalizationDto
    {
        $data = $this->validated();

        return (new LocalizationDto())
            ->setId(data_get($data, 'id'))
            ->setPoint(data_get($data, 'point'))
            ->setThemeId(data_get($data, 'theme_id'));
    }
}
