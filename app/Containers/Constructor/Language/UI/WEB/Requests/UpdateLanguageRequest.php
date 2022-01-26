<?php

namespace App\Containers\Constructor\Language\UI\WEB\Requests;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

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
