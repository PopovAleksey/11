<?php

namespace App\Containers\Constructor\Seo\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;

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
}
