<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\SeoInterface;
use App\Ship\Parents\Models\SeoLinkInterface;
use Illuminate\Support\Collection;

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
        return SeoLinkInterface::class;
    }

    /**
     * @param int                                  $languageId
     * @param array|\Illuminate\Support\Collection $contentIds
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getLinksByLanguageAndContentIds(int $languageId, array|Collection $contentIds): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->makeModel()::query()
            ->from(app(SeoLinkInterface::class)->getTable(), 'sl')
            ->leftJoin(app(SeoInterface::class)->getTable() . ' AS s', 'sl.seo_id', 's.id')
            ->whereIn('content_id', collect($contentIds)->toArray())
            ->where('s.language_id', $languageId)
            ->get();
    }
}
