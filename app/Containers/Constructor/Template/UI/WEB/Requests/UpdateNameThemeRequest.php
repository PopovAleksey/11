<?php

namespace App\Containers\Constructor\Template\UI\WEB\Requests;

use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Requests\Request;

class UpdateNameThemeRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }

    public function mapped(): ThemeDto
    {
        return (new ThemeDto())
            ->setName($this->get('name'));
    }
}
