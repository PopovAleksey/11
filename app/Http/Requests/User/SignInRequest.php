<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Mappers\Requests\User\SignInDTO;

/**
 * Class SignInRequest
 * @package App\Http\Requests\User
 */
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
            'email'    => 'required|email',
            'password' => 'required',
        ];
    }

    /**
     * @return SignInDTO
     */
    public function mappedCollection(): SignInDTO
    {
        return app(SignInDTO::class)->handler($this->validated());
    }
}
