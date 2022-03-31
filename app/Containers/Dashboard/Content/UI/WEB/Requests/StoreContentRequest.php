<?php

namespace App\Containers\Dashboard\Content\UI\WEB\Requests;

use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Ship\Parents\Requests\Request;

class StoreContentRequest extends Request
{
    public function rules(): array
    {
        return [
            // 'id' => 'required'
        ];
    }

    public function mapped(): ContentDto
    {
        return (new ContentDto());
    }
}
