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
            $insert = $data->toArray();
            
            data_set($insert, 'theme_id', $data->getTheme()?->getId());
            data_set($insert, 'language_id', $data->getLanguage()?->getId());
            data_set($insert, 'page_id', $data->getPage()?->getId());

            if ($data->getType() !== TemplateInterface::PAGE_TYPE) {
                unset($insert['page_id']);
            }
            unset($insert['theme'], $insert['language'], $insert['page']);

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

