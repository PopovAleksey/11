<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Models\ContentValue;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\SeoInterface;
use App\Ship\Parents\Models\SeoLinkInterface;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;

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
        return ContentValue::class;
    }

    /**
     * @param int         $languageId
     * @param string|null $seoLink
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getContentByLanguageAndSeoLink(int $languageId, ?string $seoLink = null): Collection
    {
        $query = $this->makeModel()::query()
            ->select([DB::raw('DISTINCT `cv`.`page_field_id`'), 'cv.id', 'cv.language_id', 'cv.content_id', 'cv.value', 'cv.created_at', 'cv.updated_at'])
            ->from(app(ContentValueInterface::class)->getTable(), 'cv')
            ->crossJoin(app(SeoLinkInterface::class)->getTable() . ' AS sl', 'cv.content_id', '=', 'sl.content_id')
            ->leftJoin(app(SeoInterface::class)->getTable() . ' AS s', 's.id', '=', 'sl.seo_id')
            ->where('cv.language_id', $languageId);

        if ($seoLink !== null) {
            return $query
                ->where('sl.link', $seoLink)
                ->get();
        }

        return $query
            ->where('cv.content_id', static function (Builder $query) {
                $query
                    ->select('value')
                    ->from(app(ConfigurationCommonInterface::class)->getTable())
                    ->where('config', ConfigurationCommonInterface::DEFAULT_INDEX);
            })
            ->get();
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
