<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateTemplateTask extends Task implements UpdateTemplateTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    public function run(TemplateDto $data): TemplateDto
    {
        try {
            $Template = $this->repository->update($data->toArray(), $data->getId());

            return (new TemplateDto())
                        ->setId($Template->id)
                        ->setCreateAt($Template->created_at)
                        ->setUpdateAt($Template->updated_at);
        }
        catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
