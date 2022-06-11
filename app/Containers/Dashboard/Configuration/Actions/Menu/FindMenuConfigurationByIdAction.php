<?php

namespace App\Containers\Dashboard\Configuration\Actions\Menu;

use App\Containers\Dashboard\Configuration\Tasks\Menu\FindMenuConfigurationByIdTaskInterface;
use App\Containers\Dashboard\Configuration\Tasks\Menu\GetAllMenuPossibleListTaskInterface;
use App\Containers\Dashboard\Configuration\Tasks\Menu\GetAllMenuTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\ConfigurationMenuItemDto;
use Illuminate\Support\Collection;

class FindMenuConfigurationByIdAction extends Action implements FindMenuConfigurationByIdActionInterface
{
    public function __construct(
        private FindMenuConfigurationByIdTaskInterface $findConfigurationByIdTask,
        private GetAllMenuPossibleListTaskInterface    $getAllMenuPossibleListTask,
        private GetAllMenuTemplateTaskInterface        $getAllMenuTemplateTask
    )
    {
    }

    public function run(int $id): Collection
    {
        $menuTemplates     = $this->getAllMenuTemplateTask->run();
        $menuData          = $this->findConfigurationByIdTask->run($id);
        $listPossibleItems = $this->getAllMenuPossibleListTask->run();
        $menuItems         = $menuData->getItems()
            ?->map(static function (ConfigurationMenuItemDto $configurationMenuItemDto) use ($listPossibleItems) {
                /**
                 * @var ConfigurationMenuItemDto|null $item
                 */
                $item = $listPossibleItems->get($configurationMenuItemDto->getContentId());

                return $configurationMenuItemDto->setName($item?->getName());
            });
        $listPossibleItems = $listPossibleItems->reject(fn(ConfigurationMenuItemDto $configurationMenuItemDto) => $menuItems?->has($configurationMenuItemDto->getContentId()));
        $menuData->setItems($menuItems);

        return collect([
            'data'      => $menuData,
            'list'      => $listPossibleItems,
            'templates' => $menuTemplates,
        ]);
    }
}
