<?php

namespace App\Containers\Dashboard\Configuration\Actions\Common;

use App\Containers\Dashboard\Configuration\Tasks\Common\GetAllCommonConfigurationTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationCommonDto;
use App\Ship\Parents\Dto\ConfigurationMultiLanguageDto;
use Illuminate\Support\Collection;

class GetAllCommonConfigurationAction extends Action implements GetAllCommonConfigurationActionInterface
{
    public function __construct(
        private readonly GetAllCommonConfigurationTaskInterface $getAllConfigurationTask
    )
    {
    }

    public function run(): ConfigurationCommonDto
    {
        $configurationCommonDto = $this->getAllConfigurationTask->run();

        $configurationMultiLanguageList = $configurationCommonDto
            ->getMultiLanguage()
            ?->groupBy(fn(ConfigurationMultiLanguageDto $multiLanguageDto) => $multiLanguageDto->getLanguageId())
            ?->map(static function (Collection $configsList) {
                return $configsList->keyBy(fn(ConfigurationMultiLanguageDto $multiLanguageDto) => $multiLanguageDto->getConfig());
            });

        return $configurationCommonDto->setMultiLanguage($configurationMultiLanguageList);
    }
}
