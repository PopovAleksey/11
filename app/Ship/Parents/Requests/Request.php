<?php

namespace App\Ship\Parents\Requests;

use Apiato\Core\Abstracts\Requests\Request as AbstractRequest;
use PopovAleksey\Mapper\Mapper;

abstract class Request extends AbstractRequest
{
    abstract public function mapped(): Mapper;
}
