<?php

namespace App\Ship\Parents\Repositories;

use App\Containers\Constructor\Seo\Models\SeoLink;

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
