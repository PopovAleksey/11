<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindConfigurationByIdTask extends Task implements FindConfigurationByIdTaskInterface
{
    public function __construct(private ConfigurationMenuRepositoryInterface $repository)
    {
    }

    public function run(int $id): ConfigurationMenuDto
    {
        try {
            $Configuration = $this->repository->find($id);

            return (new ConfigurationMenuDto())
                ->setId($Configuration->id)
                ->setCreateAt($Configuration->created_at)
                ->setUpdateAt($Configuration->updated_at);
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
