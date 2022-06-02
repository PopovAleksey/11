<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\LanguageInterface;
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
        'common_filepath'         => 'like',
        'element_filepath'        => 'like',
        'preview_filepath'        => 'like',
        'child_template_filepath' => 'like',
    ];

    public function model(): string
    {
        return TemplateInterface::class;
    }

    /**
     * @param int $themeId
     * @param int $languageId
     * @param int $pageId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findByThemeAndLanguage(int $themeId, int $languageId, int $pageId): Collection
    {
        return $this->makeModel()::query()
            ->where('theme_id', $themeId)
            ->where(static function (Builder $query) use ($pageId) {
                $query
                    ->orWhere('page_id', $pageId)
                    ->orWhere('type', TemplateInterface::WIDGET_TYPE)
                    ->orWhere('child_page_id', $pageId)
                    ->orWhere('page_id', null);
            })
            ->where(static function (Builder $query) use ($languageId) {
                $query
                    ->orWhere('language_id', $languageId)
                    ->orWhere('language_id', null);
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
            ->whereNotIn('type', [
                TemplateInterface::BASE_TYPE,
                TemplateInterface::PAGE_TYPE,
            ])
            ->leftJoin(app(LanguageInterface::class)->getTable() . ' AS l', 'l.id', '=', 't.language_id')
            ->orderBy('language_id')
            ->get();
    }

    /**
     * @param int      $themeId
     * @param int|null $languageId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getBaseTemplates(int $themeId, int $languageId = null): Collection
    {
        return $this->makeModel()::query()
            ->where([
                'type'     => TemplateInterface::BASE_TYPE,
                'theme_id' => $themeId,
            ])
            ->where(static function (Builder $query) use ($languageId) {
                $query
                    ->where('language_id', $languageId)
                    ->orWhere('language_id', null);
            })
            ->orderBy('created_at')
            ->get();
    }
}
