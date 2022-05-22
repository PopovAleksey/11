<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Dto\ConfigurationMenuItemDto;
use App\Ship\Parents\Models\ConfigurationMenuItemInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;

class FindMenuConfigurationByIdTask extends Task implements FindMenuConfigurationByIdTaskInterface
{
    public function __construct(
        private ConfigurationMenuRepositoryInterface $configurationMenuRepository,
    )
    {
    }

    public function run(int $id): ConfigurationMenuDto
    {
        /**
         * @var \App\Ship\Parents\Models\ConfigurationMenuInterface $menu
         */
        $menu  = $this->configurationMenuRepository->find($id);
        $items = $menu->items
            ->sortBy('order')
            ->map(static function (ConfigurationMenuItemInterface $configurationMenuItem) {
                return (new ConfigurationMenuItemDto())
                    ->setId($configurationMenuItem->id)
                    ->setContentId($configurationMenuItem->content_id)
                    ->setOrder($configurationMenuItem->order)
                    ->setCreateAt($configurationMenuItem->created_at)
                    ->setUpdateAt($configurationMenuItem->updated_at);
            })
            ->keyBy(fn(ConfigurationMenuItemDto $configurationMenuItemDto) => $configurationMenuItemDto->getContentId());

        return (new ConfigurationMenuDto())
            ->setId($menu->id)
            ->setName($menu->name)
            ->setActive($menu->active)
            ->setTemplateId($menu->template_id)
            ->setItems($items)
            ->setCreateAt($menu->created_at)
            ->setUpdateAt($menu->updated_at);
    }
}
