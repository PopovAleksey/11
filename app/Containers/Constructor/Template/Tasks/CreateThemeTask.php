<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Data\Repositories\ThemeRepositoryInterface;
use App\Containers\Constructor\Template\Models\ThemeInterface;
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
    public function run(ThemeDto $data): ThemeDto
    {
        try {
            if ($data->getActive() === true) {
                $activeThemeIds = $this->repository
                    ->findByField('active', true)
                    ->map(fn(ThemeInterface $theme) => $theme->id);

                if ($activeThemeIds->count() > 0) {
                    $this->repository->update(['active' => false], $activeThemeIds->toArray());
                }
            }

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

