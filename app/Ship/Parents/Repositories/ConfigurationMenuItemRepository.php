<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationMenuItemInterface;

class ConfigurationMenuItemRepository extends Repository implements ConfigurationMenuItemRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'   => '=',
        'name' => 'like',
    ];

    public function model(): string
    {
        return ConfigurationMenuItemInterface::class;
    }
}
