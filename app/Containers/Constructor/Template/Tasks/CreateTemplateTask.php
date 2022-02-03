<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\TemplateDto;
use App\Containers\Constructor\Template\Data\Repositories\TemplateRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateTemplateTask extends Task implements CreateTemplateTaskInterface
{
    public function __construct(private TemplateRepositoryInterface $repository)
    {
    }

    public function run(TemplateDto $data)
    {
        try {
            return $this->repository->create($data->toArray());
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}

