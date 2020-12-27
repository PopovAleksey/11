<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Mappers\Requests\User\SignInMapper;

class SignInRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function mappedCollection(): SignInMapper
    {
        return app(SignInMapper::class)->handler($this->input());
    }
}
