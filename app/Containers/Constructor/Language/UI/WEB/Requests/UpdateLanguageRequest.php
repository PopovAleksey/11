<?php

namespace App\Containers\Constructor\Language\UI\WEB\Requests;

use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Requests\Request;

class UpdateLanguageRequest extends Request
{
    protected array $decode = [
        'id',
    ];

    protected array $urlParameters = [
        'id',
    ];

    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
        ];
    }

    public function mapped(): LanguageDto
    {
        return (new LanguageDto())->setIsActive($this->get('active'));
    }
}
