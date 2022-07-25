<?php

namespace App\Containers\Constructor\Localization\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\LocalizationDto;
use App\Ship\Parents\Dto\LocalizationValueDto;
use App\Ship\Parents\Repositories\LocalizationRepositoryInterface;
use App\Ship\Parents\Repositories\LocalizationValueRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateLocalizationTask extends Task implements CreateLocalizationTaskInterface
{
    public function __construct(
        private readonly LocalizationRepositoryInterface      $localizationRepository,
        private readonly LocalizationValueRepositoryInterface $localizationValueRepository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\LocalizationDto $localizationDto
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(LocalizationDto $localizationDto): int
    {
        try {
            return DB::transaction(function () use ($localizationDto) {
                /**
                 * @var \App\Ship\Parents\Models\LocalizationInterface $localization
                 */
                $localization = $this->localizationRepository->create([
                    'point'    => $localizationDto->getPoint(),
                    'theme_id' => $localizationDto->getThemeId(),
                ]);

                $localizationId = $localization->id;

                $localizationDto->getValues()
                    ?->each(function (LocalizationValueDto $valueDto) use ($localizationId) {
                        $this->localizationValueRepository->create([
                            'localization_id' => $localizationId,
                            'language_id'     => $valueDto->getLanguageId(),
                            'value'           => $valueDto->getValue(),
                        ]);
                    });

                return $localizationId;
            });

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

