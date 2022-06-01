<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationCommonInterface;

class ConfigurationCommonRepository extends Repository implements ConfigurationCommonRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'     => '=',
        'config' => 'like',
        'value'  => 'like',
    ];

    public function model(): string
    {
        return ConfigurationCommonInterface::class;
    }
}
