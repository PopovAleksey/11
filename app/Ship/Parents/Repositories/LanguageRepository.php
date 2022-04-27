<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\Language;

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
        return Language::class;
    }
}
