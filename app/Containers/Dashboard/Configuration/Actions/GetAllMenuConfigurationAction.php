<?php

namespace App\Containers\Dashboard\Configuration\Actions;

use App\Containers\Dashboard\Configuration\Tasks\GetAllMenuConfigurationTaskInterface;
use App\Containers\Dashboard\Configuration\Tasks\GetAllMenuTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllMenuConfigurationAction extends Action implements GetAllMenuConfigurationActionInterface
{
    public function __construct(
        private GetAllMenuConfigurationTaskInterface $getAllConfigurationTask,
        private GetAllMenuTemplateTaskInterface      $getAllMenuTemplateTask
    )
    {
    }

    public function run(): Collection
    {
        $menuTemplates = $this->getAllMenuTemplateTask->run();
        $menuList      = $this->getAllConfigurationTask->run($menuTemplates);

        return collect([
            'templates' => $menuTemplates,
            'list'      => $menuList,
        ]);
    }
}
