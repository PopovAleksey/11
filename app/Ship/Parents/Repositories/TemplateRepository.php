<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\Template;
use App\Ship\Parents\Models\TemplateInterface;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TemplateRepository extends Repository implements TemplateRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'                      => '=',
        'name'                    => 'like',
        'type'                    => '=',
        'theme_id'                => '=',
        'page_id'                 => '=',
        'child_page_id'           => '=',
        'language_id'             => '=',
        'template_filepath'       => 'like',
        'child_template_filepath' => 'like',
    ];

    public function model(): string
    {
        return Template::class;
    }

    /**
     * @TODO Need reengineering
     * @param int $themeId
     * @param int $languageId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findByThemeAndLanguage(int $themeId, int $languageId): Collection
    {
        return $this->makeModel()::query()
            ->where(['theme_id' => $themeId])
            ->where(static function (Builder $query) use ($themeId, $languageId) {
                $query
                    ->orWhere(static function (Builder $query) use ($themeId, $languageId) {
                        $query
                            ->where('page_id', '!=', static function (\Illuminate\Database\Query\Builder $subQuery) use ($themeId, $languageId) {
                                $subQuery
                                    ->select('page_id')
                                    ->from(app(self::class)->getTable())
                                    ->where('theme_id', $themeId)
                                    ->where('language_id', $languageId);
                            })
                            ->where('language_id', null)
                            ->where('type', TemplateInterface::PAGE_TYPE);
                    })
                    ->orWhere('language_id', '!=', null)
                    ->orWhere('type', '!=', TemplateInterface::PAGE_TYPE);
            })->get();
    }

    /**
     * @param int $themeId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getIncludableItemsByTheme(int $themeId): Collection
    {
        return $this->makeModel()::query()
            ->select(DB::raw('*, t.id AS id, t.name AS name, l.name AS language_name, t.created_at, t.updated_at'))
            ->from(app(TemplateInterface::class)->getTable(), 't')
            ->where(['theme_id' => $themeId])
            ->whereIn('type', [
                TemplateInterface::JS_TYPE,
                TemplateInterface::CSS_TYPE,
                TemplateInterface::MENU_TYPE,
            ])
            ->leftJoin(app(LanguageInterface::class)->getTable() . ' AS l', 'l.id', '=', 't.language_id')
            ->orderBy('language_id')
            ->get();
    }
}
