<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Requests\Request;

class ActivateThemeRequest extends Request
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
            ->setActive($this->get('active', false));
    }
}
