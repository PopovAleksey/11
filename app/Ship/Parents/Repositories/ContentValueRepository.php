<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\SeoInterface;
use App\Ship\Parents\Models\SeoLinkInterface;
use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class ContentValueRepository extends Repository implements ContentValueRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'            => '=',
        'language_id'   => '=',
        'content_id'    => '=',
        'page_field_id' => '=',
        'value'         => 'like',
    ];

    public function model(): string
    {
        return ContentValueInterface::class;
    }

    /**
     * @param int         $languageId
     * @param string|null $seoLink
     * @return \Illuminate\Support\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getContentValuesByLanguageAndSeoLink(int $languageId, ?string $seoLink = null): Collection
    {
        $query = $this->makeModel()::query()
            ->select([DB::raw('DISTINCT `cv`.`page_field_id`'), 'cv.id', 'cv.language_id', 'cv.content_id', 'cv.value', 'cv.created_at', 'cv.updated_at'])
            ->from(app(ContentValueInterface::class)->getTable(), 'cv')
            ->leftJoin(app(SeoLinkInterface::class)->getTable() . ' AS sl', 'cv.content_id', '=', 'sl.content_id')
            ->leftJoin(app(SeoInterface::class)->getTable() . ' AS s', 's.id', '=', 'sl.seo_id')
            ->where('cv.language_id', $languageId);

        if ($seoLink !== null) {
            return $query
                ->where(static function (\Illuminate\Database\Eloquent\Builder $query) use ($seoLink) {
                    $query
                        ->where('sl.link', $seoLink)
                        ->orWhere('cv.content_id', $seoLink);
                })
                ->get()
                ->collect();
        }

        return $query
            ->where('cv.content_id', static function (Builder $query) {
                $query
                    ->select('value')
                    ->from(app(ConfigurationCommonInterface::class)->getTable())
                    ->where('config', ConfigurationCommonInterface::DEFAULT_INDEX);
            })
            ->get()
            ->collect();
    }

    /**
     * @param int                                  $languageId
     * @param array|\Illuminate\Support\Collection $contentIds
     * @return \Illuminate\Support\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getContentValuesByLanguageAndIds(int $languageId, array|Collection $contentIds): Collection
    {
        return $this->makeModel()::query()
            ->from(app(ContentValueInterface::class)->getTable())
            ->where('language_id', $languageId)
            ->whereIn('content_id', collect($contentIds)->toArray())
            ->get()
            ->collect();
    }

    /**
     * @param array $data
     * @param array $condition
     * @return bool
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function updateByCondition(array $data, array $condition): bool
    {
        return $this->makeModel()::query()
            ->where($condition)
            ->update($data);
    }
}
