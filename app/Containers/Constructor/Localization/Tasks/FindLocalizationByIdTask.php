<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\LocalizationValueDto;
use App\Ship\Parents\Models\LocalizationValuesInterface;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindLocalizationByIdTask extends Task implements FindLocalizationByIdTaskInterface
{
    public function __construct(private LocalizationRepositoryInterface $repository)
    {
    }

    /**
     * @param int $id
     * @return \App\Ship\Parents\Dto\LocalizationDto
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $id): LocalizationDto
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\LocalizationInterface $localization
             */
            $localization = $this->repository->find($id);
            $values       = $localization->values->collect()
                ->map(static function (LocalizationValuesInterface $localizationValues) {
                    return (new LocalizationValueDto())
                        ->setLocalizationId($localizationValues->localization_id)
                        ->setLanguageId($localizationValues->language_id)
                        ->setId($localizationValues->id)
                        ->setValue($localizationValues->value)
                        ->setCreateAt($localizationValues->created_at)
                        ->setUpdateAt($localizationValues->updated_at);
                });

            return (new LocalizationDto())
                ->setId($localization->id)
                ->setThemeId($localization->theme_id)
                ->setPoint($localization->point)
                ->setValues($values)
                ->setCreateAt($localization->created_at)
                ->setUpdateAt($localization->updated_at);
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
