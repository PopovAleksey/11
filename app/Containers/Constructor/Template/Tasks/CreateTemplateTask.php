<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Containers\Constructor\Template\Models\TemplateInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateTemplateTask extends Task implements CreateTemplateTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Template\Data\Dto\TemplateDto $data
     * @return int
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(TemplateDto $data): int
    {
        try {
            $insert = $data->toArray();
            
            data_set($insert, 'theme_id', $data->getTheme()?->getId());
            data_set($insert, 'language_id', $data->getLanguage()?->getId());
            data_set($insert, 'page_id', $data->getPage()?->getId());

            if ($data->getType() !== TemplateInterface::PAGE_TYPE) {
                unset($insert['page_id']);
            }
            unset($insert['theme'], $insert['language'], $insert['page']);

            /**
             * @var \App\Containers\Constructor\Template\Models\TemplateInterface $template
             */
            $template = $this->repository->create($insert);

            return $template->id;

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

