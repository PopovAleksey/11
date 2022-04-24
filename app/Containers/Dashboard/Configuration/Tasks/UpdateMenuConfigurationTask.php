<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Containers\Dashboard\Configuration\Data\Dto\MenuDto;
use App\Containers\Dashboard\Configuration\Data\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class UpdateMenuConfigurationTask extends Task implements UpdateMenuConfigurationTaskInterface
{
    public function __construct(private ConfigurationMenuRepositoryInterface $repository)
    {
    }

    /**
     * @param \Illuminate\Support\Collection $data
     * @return bool
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(Collection $data): bool
    {
        try {
            return true;
            $ConfigurationMenu = $this->repository->update($data->toArray(), $data->getId());

            return (new MenuDto())
                ->setId($ConfigurationMenu->id)
                ->setCreateAt($ConfigurationMenu->created_at)
                ->setUpdateAt($ConfigurationMenu->updated_at);
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
