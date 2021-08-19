<?php

namespace App\Containers\CoreSection\User\UI\API\Transformers;

use App\Containers\CoreSection\User\Models\User;
use App\Ship\Parents\Transformers\Transformer;

class UserTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    public function transform(User $user): array
    {
        $response = [
            'object' => $user->getResourceKey(),
            'id' => $user->getHashedKey(),
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $user->id,
            // 'deleted_at' => $user->deleted_at,
        ], $response);

        return $response;
    }
}
