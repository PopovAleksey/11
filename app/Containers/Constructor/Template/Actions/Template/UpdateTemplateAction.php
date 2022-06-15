<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Template\Tasks\Template\UpdateNameTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\UpdateTemplateTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\UpdateTemplateWidgetTaskInterface;
use App\Containers\Core\Cacher\Actions\ForgetCacheActionInterface;
use App\Containers\Core\Cacher\Data\Dto\CacheDto;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;

class UpdateTemplateAction extends Action implements UpdateTemplateActionInterface
{
    public function __construct(
        private UpdateTemplateTaskInterface       $updateTemplateTask,
        private UpdateNameTemplateTaskInterface   $updateNameTemplateTask,
        private UpdateTemplateWidgetTaskInterface $updateTemplateWidgetTask,
        private ForgetCacheActionInterface        $forgetCacheAction
    )
    {
    }

    public function run(TemplateDto $data): TemplateDto
    {
        $templateDto = $this->updateTemplateTask->run($data);
        $this->updateNameTemplateTask->run($data);

        if ($data->getWidget() !== null) {
            $this->updateTemplateWidgetTask->run($data->getWidget());
        }
        # @TODO Need Implement cleaning cache for only this Content (after implement cache with tags on memcached/redis), not full clear
        $this->forgetCacheAction->run((new CacheDto()));

        return $templateDto;
    }
}
