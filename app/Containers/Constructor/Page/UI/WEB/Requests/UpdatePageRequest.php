<?php

namespace App\Containers\Constructor\Page\UI\WEB\Requests;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Ship\Parents\Requests\Request;

class UpdatePageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'   => ['string', 'min:1', 'max:100'],
            'active' => ['boolean'],
        ];
    }

    public function mapped(): PageDto
    {
        return (new PageDto())
            ->setName($this->get('name'))
            ->setActive($this->get('active'));
    }
}
