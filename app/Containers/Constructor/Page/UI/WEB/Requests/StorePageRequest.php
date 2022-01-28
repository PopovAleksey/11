<?php

namespace App\Containers\Constructor\Page\UI\WEB\Requests;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Ship\Parents\Requests\Request;

class StorePageRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','min:1', 'max:100'],
            'type' => ['required', 'in:simple,blog,category']
        ];
    }

    public function mapped(): PageDto
    {
        return (new PageDto())
            ->setName($this->get('name'))
            ->setType($this->get('type'));
    }
}
