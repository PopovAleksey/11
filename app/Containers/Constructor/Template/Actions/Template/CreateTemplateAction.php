<?php

namespace App\Containers\Constructor\Template\Actions\Template;

use App\Containers\Constructor\Page\Tasks\Page\FindPageByIdTaskInterface;
use App\Containers\Constructor\Template\Tasks\Template\CreateTemplateTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Models\TemplateInterface;

class CreateTemplateAction extends Action implements CreateTemplateActionInterface
{
    public function __construct(
        private CreateTemplateTaskInterface $createTemplateTask,
        private FindPageByIdTaskInterface   $findPageByIdTask
    )
    {
    }

    public function run(TemplateDto $data): int
    {
        #dd($data);

        return $this->createTemplateTask->run($data);

        $templateId = $this->createTemplateTask->run($data);

        if ($pageId = $data->getPage()?->getId()) {
            $page = $this->findPageByIdTask->run($pageId);

            if ($page->getType() === PageInterface::BLOG_TYPE) {
                $childPage = $page->getChildPage();
                $templateDto = (new TemplateDto())
                    ->setType(TemplateInterface::PAGE_TYPE)
                    ->setLanguage($data->getLanguage())
                    ->setPage($childPage)
                    ->setTheme($data->getTheme());

                $this->createTemplateTask->run($templateDto);
            }
        }

        return $templateId;
    }
}

