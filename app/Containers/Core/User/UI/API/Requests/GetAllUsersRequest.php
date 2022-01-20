<?php

namespace App\Containers\Core\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class GetAllUsersRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'permissions' => 'list-users',
        'roles' => 'admin',
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

        ];
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
        ]);
    }

    public function mapped(): Mapper
    {
        return new Mapper();
    }
}
