<?php

namespace App\Containers\Dashboard\Configuration\Tasks\Menu;

use App\Ship\Parents\Dto\ConfigurationMenuItemDto;
use App\Ship\Parents\Models\ConfigurationMenuInterface;
use App\Ship\Parents\Repositories\ConfigurationMenuRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllMenuPossibleListTask extends Task implements GetAllMenuPossibleListTaskInterface
{
    public function __construct(
        private ConfigurationMenuRepositoryInterface $configurationMenuRepository
    )
    {
    }

    public function run(): Collection
    {
        return $this->configurationMenuRepository
            ->getPossibleMenuItems()
            ->groupBy('id')
            ->map(static function (Collection $configurationMenu) {
                /**
                 * @var ConfigurationMenuInterface $configurationMenu
                 */
                $configurationMenu = $configurationMenu->first();

                return (new ConfigurationMenuItemDto())
                    ->setContentId($configurationMenu->id)
                    ->setName($configurationMenu->name . ': ' . $configurationMenu->value);
            });
    }
}
