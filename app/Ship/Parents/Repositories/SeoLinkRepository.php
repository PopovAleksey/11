<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\SeoLink;

class SeoLinkRepository extends Repository implements SeoLinkRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'         => '=',
        'seo_id'     => '=',
        'content_id' => '=',
        'link'       => 'like',
    ];

    public function model(): string
    {
        return SeoLink::class;
    }
}
