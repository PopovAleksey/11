<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Requests\Request;

class StoreThemeRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'   => ['required', 'string', 'max:100'],
            'active' => ['boolean'],
        ];
    }

    public function mapped(): ThemeDto
    {
        return (new ThemeDto())
            ->setName($this->get('name'))
            ->setActive($this->get('active', true));
    }
}
