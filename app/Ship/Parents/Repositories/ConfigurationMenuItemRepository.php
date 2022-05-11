<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationMenuItem;

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
        return ConfigurationMenuItem::class;
    }
}
