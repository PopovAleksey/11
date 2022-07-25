<?php

namespace App\Ship\Parents\Repositories;

use App\Ship\Parents\Models\LanguageInterface;
use App\Ship\Parents\Models\LocalizationInterface;
use App\Ship\Parents\Models\LocalizationValuesInterface;
use App\Ship\Parents\Models\ThemeInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LocalizationRepository extends Repository implements LocalizationRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'          => '=',
        'point'       => 'like',
        'theme_id'    => '=',
    ];

    public function model(): string
    {
        return LocalizationInterface::class;
    }

    /**
     * @param int|null $languageId
     * @param int|null $themeId
     * @return \Illuminate\Support\Collection
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function getLocaleList(?int $languageId = null, ?int $themeId = null): Collection
    {
        return $this->makeModel()::query()
            ->from(app(LocalizationInterface::class)->getTable(), 'locale')
            ->select('locale.id',
                'locale.point',
                'lv.value',
                DB::raw('l.name AS language_name'),
                'lv.language_id',
                DB::raw('l.short_name AS language_short_name'),
                DB::raw('t.name AS theme_name'),
                'locale.theme_id'
            )
            ->leftJoin(app(LocalizationValuesInterface::class)->getTable() . ' AS lv', 'locale.id', 'lv.localization_id')
            ->leftJoin(app(LanguageInterface::class)->getTable() . ' AS l', 'l.id', 'lv.language_id')
            ->leftJoin(app(ThemeInterface::class)->getTable() . ' AS t', 't.id', 'locale.theme_id')
            ->when($themeId !== null, static function (Builder $query) use ($languageId) {
                $query->where('lv.language_id', $languageId);
            })
            ->when($themeId !== null, static function (Builder $query) use ($themeId) {
                $query
                    ->where('locale.theme_id', $themeId)
                    ->orWhere('locale.theme_id', null);
            })
            ->get()
            ->collect();
    }

}
