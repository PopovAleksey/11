<?php

namespace App\Containers\Constructor\Template\Tasks\Template;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\TemplateDto;
use App\Ship\Parents\Repositories\TemplateRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateNameTemplateTask extends Task implements UpdateNameTemplateTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\TemplateDto $data
     * @return bool
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(TemplateDto $data): bool
    {
        try {
            $this->repository->update(['name' => $data->getName()], $data->getId());

            return true;

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
