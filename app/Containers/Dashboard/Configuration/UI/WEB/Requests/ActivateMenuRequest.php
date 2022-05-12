<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Requests\Request;

class ActivateMenuRequest extends Request
{
    public function rules(): array
    {
        return [
            'active' => ['required', 'boolean'],
        ];
    }

    public function mapped(): ConfigurationMenuDto
    {
        return (new ConfigurationMenuDto())
            ->setActive($this->get('active', false));
    }
}
