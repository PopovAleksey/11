<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ConfigurationMenuDto;
use App\Ship\Parents\Dto\ConfigurationMenuItemDto;
use App\Ship\Parents\Repositories\ConfigurationMenuItemRepositoryInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateMenuConfigurationTask extends Task implements UpdateMenuConfigurationTaskInterface
{
    public function __construct(
        private ConfigurationMenuRepositoryInterface     $configurationMenuRepository,
        private ConfigurationMenuItemRepositoryInterface $configurationMenuItemRepository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ConfigurationMenuDto $menu
     * @return bool
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ConfigurationMenuDto $menu): bool
    {
        try {
            # @TODO Need implement transaction
            $this->configurationMenuRepository->update([
                'name'        => $menu->getName(),
                'active'      => $menu->getActive(),
                'template_id' => $menu->getTemplateId(),
            ], $menu->getId());

            $this->configurationMenuItemRepository->deleteWhere([['menu_id', '=', $menu->getId()]]);

            $menu->getItems()?->each(function (ConfigurationMenuItemDto $menuItem) use ($menu) {
                $this->configurationMenuItemRepository->create([
                    'menu_id'    => $menu->getId(),
                    'content_id' => $menuItem->getContentId(),
                    'order'      => $menuItem->getOrder(),
                ]);
            });

            return true;

        } catch (Exception $exception) {
            throw new UpdateResourceFailedException($exception->getMessage());
        }
    }
}
