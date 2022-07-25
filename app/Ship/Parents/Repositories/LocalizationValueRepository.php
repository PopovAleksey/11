<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\LocalizationValuesInterface;

class LocalizationValueRepository extends Repository implements LocalizationValueRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'              => '=',
        'localization_id' => '=',
        'language_id'     => '=',
        'value'           => 'like',
    ];


    public function model(): string
    {
        return LocalizationValuesInterface::class;
    }
}
