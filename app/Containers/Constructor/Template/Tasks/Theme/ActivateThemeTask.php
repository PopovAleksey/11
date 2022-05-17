<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class ActivateThemeTask extends Task implements ActivateThemeTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\ThemeDto $data
     * @return \App\Ship\Parents\Dto\ThemeDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ThemeDto $data): ThemeDto
    {
        try {
            $theme = $this->repository->update(['active' => $data->isActive()], $data->getId());

            return (new ThemeDto())
                ->setId($theme->id)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
