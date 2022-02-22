<?php

namespace App\Containers\Dashboard\Content\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class DeleteContentRequest extends Request
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
