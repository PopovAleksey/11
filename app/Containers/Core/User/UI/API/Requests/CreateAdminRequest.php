<?php

namespace App\Containers\Core\User\UI\API\Requests;

use App\Containers\Core\User\Data\Dto\UserDto;
use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class CreateAdminRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => 'create-admins',
        'roles'       => '',
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

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'max:40', 'unique:users,email'],
            'password' => ['required', 'min:3', 'max:30'],
            'name'     => ['min:2', 'max:50'],
        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }

    public function mapped(): UserDto
    {
        $data = $this->validated();

        return (new UserDto())
            ->setName(data_get($data, 'name'))
            ->setPassword(data_get($data, 'password'))
            ->setEmail(data_get($data, 'email'));
    }
}
