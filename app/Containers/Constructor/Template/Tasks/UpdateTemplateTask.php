<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateTemplateTask extends Task implements UpdateTemplateTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto $data
     * @return \App\Ship\Parents\Dto\TemplateDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(TemplateDto $data): TemplateDto
    {
        try {
            /**
             * @var \App\Containers\Constructor\Template\Models\TemplateInterface $template
             */
            $template = $this->repository->update($data->toArray(), $data->getId());

            return (new TemplateDto())
                ->setId($template->id)
                ->setCreateAt($template->created_at)
                ->setUpdateAt($template->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
