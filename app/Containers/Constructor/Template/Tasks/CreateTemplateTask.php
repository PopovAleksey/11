<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Models\TemplateInterface;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateTemplateTask extends Task implements CreateTemplateTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(TemplateDto $data): int
    {
        try {
            if ($data->getName() === null) {
                $name = match ($data->getType()) {
                    TemplateInterface::PAGE_TYPE => $data->getPage()?->getName(),
                    TemplateInterface::MENU_TYPE, TemplateInterface::BASE_TYPE => ucfirst($data->getType()),
                    TemplateInterface::CSS_TYPE, TemplateInterface::JS_TYPE => strtoupper($data->getType())
                };
                $data->setName($name);
            }

            $insert = [
                'type'          => $data->getType(),
                'name'          => $data->getName(),
                'theme_id'      => $data->getTheme()?->getId(),
                'page_id'       => $data->getType() === TemplateInterface::PAGE_TYPE ? $data->getPage()?->getId() : null,
                'child_page_id' => $data->getType() === TemplateInterface::PAGE_TYPE ? $data->getPage()?->getChildPage()?->getId() : null,
                'language_id'   => $data->getLanguage()?->getId(),
            ];

            /**
             * @var \App\Ship\Parents\Models\TemplateInterface $template
             */
            $template = $this->repository->create($insert);

            return $template->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

