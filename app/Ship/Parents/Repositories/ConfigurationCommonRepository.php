<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationCommon;

class ConfigurationCommonRepository extends Repository implements ConfigurationCommonRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    public function model(): string
    {
        return ConfigurationCommon::class;
    }
}
