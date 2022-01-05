<?php

namespace App\Containers\Development\Logger\UI\API\Transformers;

use App\Containers\Development\Logger\Models\Logger;
use App\Ship\Parents\Transformers\Transformer;

class LoggerTransformer extends Transformer
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

    public function transform(Logger $logger): array
    {
        $response = [
            'object' => $logger->getResourceKey(),
            'id' => $logger->getHashedKey(),
            'created_at' => $logger->created_at,
            'updated_at' => $logger->updated_at,
            'readable_created_at' => $logger->created_at->diffForHumans(),
            'readable_updated_at' => $logger->updated_at->diffForHumans(),

        ];

        return $response = $this->ifAdmin([
            'real_id'    => $logger->id,
            // 'deleted_at' => $logger->deleted_at,
        ], $response);
    }
}
