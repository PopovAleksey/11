<?php

namespace App\Containers\Dashboard\Configuration\Tasks;

use App\Containers\Dashboard\Configuration\Data\Repositories\ConfigurationMenuRepositoryInterface;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllMenuConfigurationTask extends Task implements GetAllMenuConfigurationTaskInterface
{
    public function __construct(
        private ConfigurationMenuRepositoryInterface $configurationMenuRepository,
        private ContentRepositoryInterface           $contentRepository
    )
    {
    }

    public function run(): Collection
    {
        $contentList = $this->contentRepository->all()->collect();
        $menuList    = $this->configurationMenuRepository->all()->collect();
        dump($contentList, $menuList);

        return collect();
    }
}
