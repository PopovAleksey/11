<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
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
    public function run(ThemeDto $data): ThemeDto
    {
        try {
            $this->repository
                ->findByField('active', true)
                ->each(fn(ThemeInterface $theme) => $this->repository->update(['active' => false], $theme->id));

            /**
             * @var ThemeInterface $theme
             */
            $theme = $this->repository->create($data->toArray());

            return (new ThemeDto())
                ->setId($theme->id)
                ->setName($theme->name)
                ->setActive($theme->active)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);

        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}

