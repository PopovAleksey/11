<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\LocalizationValueDto;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\LocalizationInterface;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllLocalizationsTask extends Task implements GetAllLocalizationsTaskInterface
{
    public function __construct(private readonly LocalizationRepositoryInterface $repository)
    {
    }

    public function run(): Collection
    {
        return $this->repository->getLocaleList()
            ->groupBy([
                fn(LocalizationInterface $localization) => $localization->language_id,
                fn(LocalizationInterface $localization) => $localization->id,
            ])
            ->map(static function (Collection $pointList) {
                return $pointList->map(static function (Collection $points) {
                    $localizationDto = null;

                    $values = $points->map(static function (LocalizationInterface $localization) use (&$localizationDto) {
                        if ($localizationDto === null) {
                            $theme = (new ThemeDto())
                                ->setId($localization->theme_id)
                                ->setName($localization->theme_name);

                            $localizationDto = (new LocalizationDto())
                                ->setId($localization->id)
                                ->setPoint($localization->point)
                                ->setThemeId($localization->theme_id)
                                ->setTheme($theme)
                                ->setCreateAt($localization->created_at)
                                ->setUpdateAt($localization->updated_at);
                        }

                        $languageDto = (new LanguageDto())
                            ->setId($localization->language_id)
                            ->setShortName($localization->language_short_name)
                            ->setName($localization->language_name);

                        return (new LocalizationValueDto())
                            ->setLocalizationId($localizationDto->getId())
                            ->setLanguageId($languageDto->getId())
                            ->setLanguage($languageDto)
                            ->setValue($localization->value);
                    });

                    return $localizationDto->setValues($values);
                });
            });
    }
}
