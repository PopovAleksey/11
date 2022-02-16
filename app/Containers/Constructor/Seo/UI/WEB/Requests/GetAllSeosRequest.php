<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class GetAllSeosRequest extends Request
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
