<?php

namespace App\Containers\Constructor\Language\UI\WEB\Requests;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Ship\Parents\Requests\Request;

class StoreLanguageRequest extends Request
{
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:2'],
        ];
    }

    public function mapped(): LanguageDto
    {
        return (new LanguageDto())->setShortName($this->get('code'));
    }
}
