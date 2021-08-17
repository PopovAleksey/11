<?php

namespace App\Containers\ConstructorSection\Site\UI\API\Transformers;

use App\Containers\ConstructorSection\Site\Models\Site;
use App\Ship\Parents\Transformers\Transformer;

class SiteTransformer extends Transformer
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

    public function transform(Site $site): array
    {
        $response = [
            'object' => $site->getResourceKey(),
            'id' => $site->getHashedKey(),
            'created_at' => $site->created_at,
            'updated_at' => $site->updated_at,
            'readable_created_at' => $site->created_at->diffForHumans(),
            'readable_updated_at' => $site->updated_at->diffForHumans(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $site->id,
            // 'deleted_at' => $site->deleted_at,
        ], $response);

        return $response;
    }
}
