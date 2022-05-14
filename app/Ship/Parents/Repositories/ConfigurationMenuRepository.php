<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ConfigurationMenu;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Models\ConfigurationMenuItemInterface;
use App\Ship\Parents\Models\ContentInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\SeoInterface;
use App\Ship\Parents\Models\SeoLinkInterface;
use App\Ship\Parents\Models\TemplateInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
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
    public function getLinkDataOfMenuItems(int $languageId, int $themeId): Collection|array
    {
        return $this->makeModel()::query()
            ->select('cm.id', 'cm.template_id', 'sl.link', 'cv.value', 'l.short_name')
            ->from(app(ConfigurationMenuInterface::class)->getTable(), 'cm')
            ->leftJoin(app(ConfigurationMenuItemInterface::class)->getTable() . ' AS cmi', 'cm.id', '=', 'cmi.menu_id')
            ->leftJoin(app(ContentInterface::class)->getTable() . ' AS c', 'c.id', '=', 'cmi.content_id')
            ->leftJoin(app(ContentValueInterface::class)->getTable() . ' AS cv', 'cv.content_id', '=', 'c.id')
            ->leftJoin(app(TemplateInterface::class)->getTable() . ' AS t', 't.id', '=', 'cm.template_id')
            ->rightJoin(app(SeoLinkInterface::class)->getTable() . ' AS sl', 'cmi.content_id', '=', 'sl.content_id')
            ->rightJoin(app(SeoInterface::class)->getTable() . ' AS s', 's.id', '=', 'sl.seo_id')
            ->leftJoin(app(LanguageInterface::class)->getTable() . ' AS l', 'l.id', '=', 'cv.language_id')
            ->where('cm.active', true)
            ->where('c.active', true)
            ->where('cv.language_id', $languageId)
            ->where(static function (Builder $query) {
                $query
                    ->where('t.language_id', DB::raw('cv.language_id'))
                    ->orWhere('t.language_id', null);
            })
            ->where('s.language_id', DB::raw('cv.language_id'))
            ->where('t.theme_id', $themeId)
            ->where('cv.page_field_id', DB::raw('s.page_field_id'))
            ->get();

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
            ->dd();
        //->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|array
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getPossibleMenuItems(): Collection|array
    {
        return $this->makeModel()::query()
            ->select('c.id', 'cv.value')
            ->from(app(ContentInterface::class)->getTable(), 'c')
            ->rightJoin(app(ContentValueInterface::class)->getTable() . ' AS cv', 'c.id', '=', 'cv.content_id')
            ->where('c.active', true)
            ->where('c.parent_content_id', null)
            ->where('cv.language_id', 1)
            ->get();
    }
}
