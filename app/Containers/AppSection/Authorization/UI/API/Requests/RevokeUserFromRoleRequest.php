<?php

namespace App\Containers\AppSection\Authorization\UI\API\Requests;

use App\Ship\Parents\Requests\Request;
use PopovAleksey\Mapper\Mapper;

class RevokeUserFromRoleRequest extends Request
{
    /**
     * Define which Roles and/or Permissions has access to this request.
     */
    protected array $access = [
        'roles' => '',
        'permissions' => 'manage-admins-access',
    ];

    /**
     * Id's that needs decoding before applying the validation rules.
     */
    protected array $decode = [
        'roles_ids.*',
        'user_id',
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
            'roles_ids' => 'required',
            'roles_ids.*' => 'exists:' . config('permission.table_names.roles') . ',id',
            'user_id' => 'required|exists:users,id',
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
