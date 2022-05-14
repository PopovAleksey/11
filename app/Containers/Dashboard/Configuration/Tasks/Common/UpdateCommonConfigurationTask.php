<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Common;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ConfigurationCommonDto;
use App\Ship\Parents\Models\ConfigurationCommonInterface;
use App\Ship\Parents\Repositories\ConfigurationCommonRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateCommonConfigurationTask extends Task implements UpdateCommonConfigurationTaskInterface
{
    public function __construct(private ConfigurationCommonRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ConfigurationCommonDto $data
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ConfigurationCommonDto $data): void
    {
        try {
            if ($data->getDefaultLanguageId() !== null) {
                $this->repository->updateOrCreate(
                    ['config' => ConfigurationCommonInterface::DEFAULT_LANGUAGE],
                    ['value' => $data->getDefaultLanguageId()]
                );
            }

            if ($data->getDefaultIndexContentId() !== null) {
                $this->repository->updateOrCreate(
                    ['config' => ConfigurationCommonInterface::DEFAULT_INDEX],
                    ['value' => $data->getDefaultIndexContentId()]
                );
            }

            if ($data->getDefaultThemeId() !== null) {
                $this->repository->updateOrCreate(
                    ['config' => ConfigurationCommonInterface::DEFAULT_THEME],
                    ['value' => $data->getDefaultThemeId()]
                );
            }


        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
