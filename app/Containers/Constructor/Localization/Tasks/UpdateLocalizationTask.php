<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\LocalizationValueDto;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Repositories\LocalizationValueRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateLocalizationTask extends Task implements UpdateLocalizationTaskInterface
{
    public function __construct(
        private readonly LocalizationRepositoryInterface      $localizationRepository,
        private readonly LocalizationValueRepositoryInterface $localizationValueRepository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\LocalizationDto $localizationDto
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(LocalizationDto $localizationDto): void
    {
        try {
            DB::transaction(function () use ($localizationDto) {
                $this->localizationRepository->update([
                    'point'    => $localizationDto->getPoint(),
                    'theme_id' => $localizationDto->getThemeId(),
                ], $localizationDto->getId());

                $localizationDto->getValues()
                    ?->each(function (LocalizationValueDto $valueDto) use ($localizationDto) {
                        $this->localizationValueRepository->updateOrCreate(
                            [
                                'localization_id' => $localizationDto->getId(),
                                'language_id'     => $valueDto->getLanguageId(),
                            ],
                            [
                                'value' => $valueDto->getValue(),
                            ]
                        );
                    });
            });
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
