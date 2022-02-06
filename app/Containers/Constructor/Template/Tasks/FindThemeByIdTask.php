<?php

namespace App\Containers\Constuctor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Data\Repositories\ThemeRepositoryInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class FindThemeByIdTask extends Task implements FindThemeByIdTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    public function run(int $id): ThemeDto
    {
        try {
            $Theme = $this->repository->find($id);

            return (new ThemeDto())
                        ->setId($Theme->id)
                        ->setCreateAt($Theme->created_at)
                        ->setUpdateAt($Theme->updated_at);
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
