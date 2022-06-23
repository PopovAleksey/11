<?php

namespace App\Containers\Constructor\Localization\UI\API\Controllers;

use App\Containers\Constructor\Localization\Actions\FindLocalizationByIdActionInterface;
use App\Containers\Constructor\Localization\UI\API\Transformers\FindLocalizationTransformer;
use App\Ship\Parents\Controllers\ApiController;

class Controller extends ApiController
{
    public function __construct(
        private FindLocalizationByIdActionInterface $findLocalizationByIdAction
    )
    {
    }

    /**
     * @param int $id
     * @return array
     * @throws \Apiato\Core\Exceptions\InvalidTransformerException
     */
    public function find(int $id): array
    {
        $localization = $this->findLocalizationByIdAction->run($id);

        return $this->transform($localization, FindLocalizationTransformer::class);
    }
}
