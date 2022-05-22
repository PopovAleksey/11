<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateNameThemeTask extends Task implements UpdateNameThemeTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $data
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ThemeDto $data): void
    {
        try {
            $this->repository->update(['name' => $data->getName()], $data->getId());

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
