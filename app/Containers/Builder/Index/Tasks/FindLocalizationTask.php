<?php

namespace App\Containers\Builder\Index\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\LocalizationValueDto;
use App\Ship\Parents\Models\LocalizationInterface;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class FindLocalizationTask extends Task implements FindLocalizationTaskInterface
{
    public function __construct(
        private readonly LocalizationRepositoryInterface $repository
    )
    {
    }

    /**
     * @param int                            $languageId
     * @param int                            $themeId
     * @param \Illuminate\Support\Collection $localizationPoints
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $languageId, int $themeId, Collection $localizationPoints): Collection
    {
        try {
            $points = $localizationPoints
                ->map(fn(LocalizationDto $localizationDto) => $localizationDto->getPoint())
                ->reject(fn(?string $localePoint) => $localePoint === null)
                ->unique()
                ->values();

            $localizationModel = $this->repository->getLocaleList($languageId, $themeId, $points)->groupBy('point');

            return $localizationPoints
                ->map(static function (LocalizationDto $localizationDto) use ($localizationModel) {
                    $localePointCollection = $localizationModel->get($localizationDto->getPoint());

                    if ($localePointCollection === null) {
                        return null;
                    }

                    $values = $localePointCollection
                        ->map(static function (LocalizationInterface $localization) use (&$localizationDto) {
                            $localizationDto
                                ->setId($localization->id)
                                ->setThemeId($localization->theme_id);

                            return (new LocalizationValueDto())
                                ->setLanguageId($localization->language_id)
                                ->setValue($localization->value)
                                ->setLocalizationId($localization->id);
                        });

                    return $localizationDto
                        ->setValues($values);

                })->reject(fn($localePoint) => $localePoint === null);

        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
