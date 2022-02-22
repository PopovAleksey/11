<?php

namespace App\Containers\Dashboard\Content\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class EditContentRequest extends Request
{
    public function rules(): array
    {
        return [
            // 'id' => 'required'
        ];
    }

    public function mapped(): Mapper
    {
        return (new Mapper());
    }
}
