<?php

namespace App\Ship\Parents\Repositories;

use App\Containers\Dashboard\Configuration\Models\ConfigurationMenu;

class ConfigurationMenuRepository extends Repository implements ConfigurationMenuRepositoryInterface
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
        return ConfigurationMenu::class;
    }
}
