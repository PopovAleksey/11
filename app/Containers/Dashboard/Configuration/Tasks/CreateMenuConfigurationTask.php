<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateMenuConfigurationTask extends Task implements CreateMenuConfigurationTaskInterface
{
    public function __construct(private ConfigurationMenuRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ConfigurationMenuDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(ConfigurationMenuDto $data): int
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\ConfigurationMenuInterface $menu
             */
            $menu = $this->repository->create([
                'name'        => $data->getName(),
                'active'      => $data->getActive(),
                'template_id' => $data->getTemplateId(),
            ]);

            return $menu->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}