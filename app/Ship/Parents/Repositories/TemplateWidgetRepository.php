<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\ContentInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Models\SeoInterface;
use App\Ship\Parents\Models\SeoLinkInterface;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Models\TemplateWidgetInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class TemplateWidgetRepository extends Repository implements TemplateWidgetRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'             => '=',
        'template_id'    => '=',
        'count_elements' => '=',
        'show_by'        => '=',
    ];

    public function model(): string
    {
        return TemplateWidgetInterface::class;
    }

    /**
     * @param int                            $widgetTemplateId
     * @param int                            $languageId
     * @param \Illuminate\Support\Collection $contentIds
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getWidgetContents(int $widgetTemplateId, int $languageId, Collection $contentIds): EloquentCollection
    {
        /*$this->makeModel()::query()
            ->select('tw.id', 'tw.template_id', 'c.id as content_id', 'c.page_id', 'cv.page_field_id', 'sl.link', 's.language_id', 'cv.value', 'l.short_name')
            ->from(app(TemplateWidgetInterface::class)->getTable(), 'tw')
            ->leftJoin(app(TemplateInterface::class)->getTable() . ' AS t', 't.id', '=', 'tw.template_id')
            ->leftJoin(app(PageInterface::class)->getTable() . ' AS p', 'p.id', '=', 't.page_id')
            ->leftJoin(app(ContentInterface::class)->getTable() . ' AS c', 'p.id', '=', 'c.page_id')
            ->leftJoin(app(ContentValueInterface::class)->getTable() . ' AS cv', 'c.id', '=', 'cv.content_id')
            ->leftJoin(app(LanguageInterface::class)->getTable() . ' AS l', 'l.id', '=', 'cv.language_id')
            ->leftJoin(app(SeoLinkInterface::class)->getTable() . ' AS sl', 'c.id', '=', 'sl.content_id')
            ->leftJoin(app(SeoInterface::class)->getTable() . ' AS s', 's.id', '=', 'sl.seo_id')
            ->where([
                't.id'           => $widgetTemplateId,
                'p.active'       => true,
                'c.active'       => true,
                'cv.language_id' => $languageId,
            ])
            ->whereIn('cv.content_id', $contentIds->toArray())
            ->where(static function (Builder $query) {
                $query
                    ->where('t.language_id', '=', DB::raw('cv.language_id'))
                    ->orWhere('t.language_id', '=', null);
            })
            ->where(static function (Builder $query) {
                $query
                    ->where('s.language_id', '=', DB::raw('cv.language_id'))
                    ->orWhere('s.language_id', '=', null);
            })->dd();*/

        return $this->makeModel()::query()
            ->select('tw.id', 'tw.template_id', 'c.id as content_id', 'c.page_id', 'cv.page_field_id', 'sl.link', 's.language_id', 's.active AS seo_active', 'cv.value', 'l.short_name')
            ->from(app(TemplateWidgetInterface::class)->getTable(), 'tw')
            ->leftJoin(app(TemplateInterface::class)->getTable() . ' AS t', 't.id', '=', 'tw.template_id')
            ->leftJoin(app(PageInterface::class)->getTable() . ' AS p', 'p.id', '=', 't.page_id')
            ->leftJoin(app(ContentInterface::class)->getTable() . ' AS c', 'p.id', '=', 'c.page_id')
            ->leftJoin(app(ContentValueInterface::class)->getTable() . ' AS cv', 'c.id', '=', 'cv.content_id')
            ->leftJoin(app(LanguageInterface::class)->getTable() . ' AS l', 'l.id', '=', 'cv.language_id')
            ->leftJoin(app(SeoLinkInterface::class)->getTable() . ' AS sl', 'c.id', '=', 'sl.content_id')
            ->leftJoin(app(SeoInterface::class)->getTable() . ' AS s', 's.id', '=', 'sl.seo_id')
            ->where([
                't.id'           => $widgetTemplateId,
                'p.active'       => true,
                'c.active'       => true,
                'cv.language_id' => $languageId,
            ])
            ->whereIn('cv.content_id', $contentIds->toArray())
            ->where(static function (Builder $query) {
                $query
                    ->where('t.language_id', '=', DB::raw('cv.language_id'))
                    ->orWhere('t.language_id', '=', null);
            })
            ->where(static function (Builder $query) {
                $query
                    ->where('s.language_id', '=', DB::raw('cv.language_id'))
                    ->orWhere('s.language_id', '=', null);
            })
            ->get();
    }
}
