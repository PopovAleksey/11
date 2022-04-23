<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Containers\Dashboard\Configuration\Data\Dto\MenuDto;
use App\Containers\Dashboard\Configuration\Data\Repositories\ConfigurationMenuRepositoryInterface;
use App\Containers\Dashboard\Configuration\Models\ConfigurationInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllMenuConfigurationTask extends Task implements GetAllConfigurationTaskInterface
{
    public function __construct(private ConfigurationMenuRepositoryInterface $repository)
    {
    }

    public function run(): Collection
    {
        return $this->repository->all()->collect()->map(static function (ConfigurationInterface $Configuration) {
            return (new MenuDto())
                ->setId($Configuration->id)
                ->setCreateAt($Configuration->created_at)
                ->setUpdateAt($Configuration->updated_at);
        });
    }
}
