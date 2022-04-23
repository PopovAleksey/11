<?php

namespace App\Containers\Dashboard\Configuration\UI\WEB\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class FindConfigurationByIdRequest extends Request
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
