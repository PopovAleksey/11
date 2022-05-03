<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationMenu;
use App\Ship\Parents\Models\ContentInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\SeoInterface;
use App\Ship\Parents\Models\SeoLinkInterface;
use DB;
use Illuminate\Database\Eloquent\Collection;

class ConfigurationMenuRepository extends Repository implements ConfigurationMenuRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];

    public function model(): string
    {
        return ConfigurationMenu::class;
    }

    /**
     * @param int $languageId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getLinkDataOfMenuItems(int $languageId): Collection|array
    {
        return $this->makeModel()::query()
            ->select('sl.link', 'cv.value', 'l.short_name')
            ->from(app(self::class)->getTable(), 'cm')
            ->crossJoin(app(ContentValueInterface::class)->getTable() . ' AS cv', 'cm.content_id', '=', 'cv.content_id')
            ->crossJoin(app(ContentInterface::class)->getTable() . ' AS c', 'c.id', '=', 'cv.content_id')
            ->leftJoin(app(SeoLinkInterface::class)->getTable() . ' AS sl', 'cm.content_id', '=', 'sl.content_id')
            ->leftJoin(app(SeoInterface::class)->getTable() . ' AS s', 's.id', '=', 'sl.seo_id')
            ->leftJoin(app(LanguageInterface::class)->getTable() . ' AS l', 'l.id', '=', 'cv.language_id')
            ->where('s.page_field_id', DB::raw('`cv`.`page_field_id`'))
            ->where('cv.language_id', $languageId)
            ->where('s.language_id', DB::raw('`cv`.`language_id`'))
            ->where('c.active', true)
            ->get();
    }
}
