<?php

namespace App\Containers\Constructor\Page\UI\WEB\Requests;

use App\Containers\Constructor\Page\Models\PageInterface;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Requests\Request;

class StorePageRequest extends Request
{
    public function rules(): array
    {
        $types = collect([
            PageInterface::SIMPLE_TYPE,
            PageInterface::BLOG_TYPE,
            PageInterface::CATEGORY_TYPE,
        ])->implode(',');

        return [
            'name' => ['required', 'string', 'min:1', 'max:100'],
            'type' => ['required', 'in:' . $types],
        ];
    }

    public function mapped(): PageDto
    {
        return (new PageDto())
            ->setName($this->get('name'))
            ->setType($this->get('type'));
    }
}
