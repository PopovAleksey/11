<?php

namespace App\Containers\Constructor\Seo\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class FindSeoByIdRequest extends Request
{
    public function rules(): array
    {
        return [
        ];
    }

    public function mapped(): Mapper
    {
        return (new Mapper());
    }
}
