<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindTemplateByIdTask extends Task implements FindTemplateByIdTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    public function run(int $id): TemplateDto
    {
        try {
            $Template = $this->repository->find($id);

            return (new TemplateDto())
                        ->setId($Template->id)
                        ->setCreateAt($Template->created_at)
                        ->setUpdateAt($Template->updated_at);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
