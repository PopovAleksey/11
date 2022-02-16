<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Requests;

use App\Containers\Constructor\Seo\Data\Dto\SeoDto;
use App\Ship\Parents\Requests\Request;

class UpdateSeoRequest extends Request
{
    public function rules(): array
    {
        return [
            'active' => ['required_without:static', 'boolean'],
            'static' => ['required_without:active', 'boolean'],
        ];
    }

    public function mapped(): SeoDto
    {
        return (new SeoDto())
            ->setActive($this->get('active'))
            ->setStatic($this->get('static'));
    }
}
