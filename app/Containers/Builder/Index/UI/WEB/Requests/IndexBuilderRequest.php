<?php

namespace App\Containers\Builder\Index\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class IndexBuilderRequest extends Request
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
