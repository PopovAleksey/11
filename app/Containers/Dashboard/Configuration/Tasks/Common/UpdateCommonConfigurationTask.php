<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Common;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ConfigurationCommonDto;
use App\Ship\Parents\Dto\ConfigurationMultiLanguageDto;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Repositories\ConfigurationCommonRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateCommonConfigurationTask extends Task implements UpdateCommonConfigurationTaskInterface
{
    public function __construct(
        private readonly ConfigurationCommonRepositoryInterface $repository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ConfigurationCommonDto $configurationCommonDto
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ConfigurationCommonDto $configurationCommonDto): void
    {
        try {
            if ($configurationCommonDto->getDefaultLanguageId() !== null) {
                $this->repository->updateOrCreate(
                    ['config' => ConfigurationCommonInterface::DEFAULT_LANGUAGE],
                    ['value' => $configurationCommonDto->getDefaultLanguageId()]
                );
            }

            if ($configurationCommonDto->getDefaultIndexContentId() !== null) {
                $this->repository->updateOrCreate(
                    ['config' => ConfigurationCommonInterface::DEFAULT_INDEX],
                    ['value' => $configurationCommonDto->getDefaultIndexContentId()]
                );
            }

            if ($configurationCommonDto->getDefaultThemeId() !== null) {
                $this->repository->updateOrCreate(
                    ['config' => ConfigurationCommonInterface::DEFAULT_THEME],
                    ['value' => $configurationCommonDto->getDefaultThemeId()]
                );
            }

            $configurationCommonDto
                ->getMultiLanguage()
                ?->each(function (ConfigurationMultiLanguageDto $multiLanguageDto) {
                    if (!$this->isCorrectConfig($multiLanguageDto->getConfig())) {
                        return;
                    }

                    $this->repository->updateOrCreate(
                        [
                            'config'      => $multiLanguageDto->getConfig(),
                            'language_id' => $multiLanguageDto->getLanguageId(),
                        ],
                        [
                            'value'       => $multiLanguageDto->getValue(),
                        ]
                    );
                });

        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception->getMessage());
        }
    }

    /**
     * @param string $config
     * @return bool
     */
    private function isCorrectConfig(string $config): bool
    {
        return collect([
                ConfigurationCommonInterface::TITLE,
                ConfigurationCommonInterface::DESCRIPTION,
                ConfigurationCommonInterface::TITLE_SEPARATOR,
                ConfigurationCommonInterface::META_CHARSET,
                ConfigurationCommonInterface::META_DESCRIPTION,
                ConfigurationCommonInterface::META_KEYWORDS,
                ConfigurationCommonInterface::META_AUTHOR,
            ])->search($config) !== false;
    }
}
