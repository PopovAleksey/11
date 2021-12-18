<?php

namespace App\Containers\CoreSection\Authentication\UI\API\Transformers;

use App\Containers\CoreSection\Authentication\Models\Authentication;
use App\Ship\Parents\Transformers\Transformer;

class AuthenticationTransformer extends Transformer
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

    public function transform(Authentication $authentication): array
    {
        $response = [
            'object' => $authentication->getResourceKey(),
            'id' => $authentication->getHashedKey(),
            'created_at' => $authentication->created_at,
            'updated_at' => $authentication->updated_at,
            'readable_created_at' => $authentication->created_at->diffForHumans(),
            'readable_updated_at' => $authentication->updated_at->diffForHumans(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $authentication->id,
            // 'deleted_at' => $authentication->deleted_at,
        ], $response);

        return $response;
    }
}
