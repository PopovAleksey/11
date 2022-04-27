<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Requests\Request;

class UpdateThemeRequest extends Request
{
    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
        ];
    }

    public function mapped(): ThemeDto
    {
        return (new ThemeDto())
            ->setName($this->get('name'))
            ->setActive($this->get('active', false));
    }
}
