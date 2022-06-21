<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\LocalizationInterface;

class LocalizationRepository extends Repository implements LocalizationRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'          => '=',
        'point'       => 'like',
        'language_id' => '=',
        'theme_id'    => '=',
        'value'       => 'like',
    ];

    public function model(): string
    {
        return LocalizationInterface::class;
    }
}
