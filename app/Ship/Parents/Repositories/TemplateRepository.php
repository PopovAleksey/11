<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\Template;
use App\Ship\Parents\Models\TemplateInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TemplateRepository extends Repository implements TemplateRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'          => '=',
        'type'        => '=',
        'theme_id'    => '=',
        'page_id'     => '=',
        'language_id' => '=',
        'html'        => 'like',
    ];

    public function model(): string
    {
        return Template::class;
    }

    /**
     * @param int $themeId
     * @param int $languageId
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findByThemeAndLanguage(int $themeId, int $languageId): Collection
    {
        return $this->makeModel()::where(['theme_id' => $themeId])
            ->where(static function (Builder $query) use ($themeId, $languageId) {
                $query
                    ->orWhere(static function (Builder $query) use ($themeId, $languageId) {
                        $query
                            ->where('page_id', '!=', static function (\Illuminate\Database\Query\Builder $subQuery) use ($themeId, $languageId) {
                                $subQuery
                                    ->select('page_id')
                                    ->from(app(Template::class)->getTable())
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
}
