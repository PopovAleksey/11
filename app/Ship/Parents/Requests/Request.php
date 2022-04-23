<?php

namespace App\Ship\Parents\Requests;

use Apiato\Core\Abstracts\Requests\Request as AbstractRequest;
use Illuminate\Support\Collection;
use PopovAleksey\Mapper\Mapper;

abstract class Request extends AbstractRequest
{
    abstract public function mapped(): Mapper|Collection;
}
