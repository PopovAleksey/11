<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Data\Repositories\ThemeRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateThemeTask extends Task implements UpdateThemeTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Template\Data\Dto\ThemeDto $data
     * @return \App\Containers\Constructor\Template\Data\Dto\ThemeDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(ThemeDto $data): ThemeDto
    {
        try {
            /**
             * @var \App\Containers\Constructor\Template\Models\ThemeInterface $theme
             */
            $theme = $this->repository->update($data->toArray(), $data->getId());

            return (new ThemeDto())
                ->setId($theme->id)
                ->setName($theme->name)
                ->setActive($theme->active)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
