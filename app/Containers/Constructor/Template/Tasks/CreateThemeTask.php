<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Data\Repositories\ThemeRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateThemeTask extends Task implements CreateThemeTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(ThemeDto $data)
    {
        try {
            return $this->repository->create($data->toArray());
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

