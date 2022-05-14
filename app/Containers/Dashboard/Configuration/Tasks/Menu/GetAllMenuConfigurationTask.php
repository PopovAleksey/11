<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllMenuConfigurationTask extends Task implements GetAllMenuConfigurationTaskInterface
{
    public function __construct(
        private ConfigurationMenuRepositoryInterface $configurationMenuRepository
    )
    {
    }

    public function run(Collection $menuTemplates): Collection
    {

        return $this->configurationMenuRepository
            ->all()
            ->collect()
            ->map(static function (ConfigurationMenuInterface $configurationMenu) use ($menuTemplates) {
                return (new ConfigurationMenuDto())
                    ->setId($configurationMenu->id)
                    ->setName($configurationMenu->name)
                    ->setActive($configurationMenu->active)
                    ->setTemplateId($configurationMenu->template_id)
                    ->setTemplate($menuTemplates->get($configurationMenu->template_id))
                    ->setCreateAt($configurationMenu->created_at)
                    ->setUpdateAt($configurationMenu->updated_at);
            });
    }
}
