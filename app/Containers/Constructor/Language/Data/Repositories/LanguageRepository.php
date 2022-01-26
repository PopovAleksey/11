<?php

namespace App\Containers\Constructor\Language\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

class LanguageRepository extends Repository implements LanguageRepositoryInterface
{
    protected $fieldSearchable = [
        'id'         => '=',
        'name'       => 'like',
        'short_name' => '=',
        'action'     => '=',
    ];

    public function model(): string
    {
        return config('constructor-language.models.language');
    }
}
