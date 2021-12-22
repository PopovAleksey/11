<?php

namespace App\Containers\AppSection\Authentication\UI\WEB\Requests;

use App\Containers\AppSection\Authentication\Data\Dto\LoginDto;
use App\Ship\Parents\Requests\Request;

class LoginRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => NULL,
        'roles'       => NULL,
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [

    ];

    /**
     * Defining the URL parameters (`/stores/999/items`) allows applying
     * validation rules on them and allows accessing them like request data.
     */
    protected array $urlParameters = [

    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email'      => ['required', 'email'],
            'password'   => ['required', 'min:3', 'max:30'],
            'rememberMe' => ['bool'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }

    public function mapped(): LoginDto
    {
        $data = $this->validated();

        return (new LoginDto())
            ->setEmail(data_get($data, 'email'))
            ->setPassword(data_get($data, 'password'))
            ->setRememberMe(data_get($data,'rememberMe', true));
    }
}
