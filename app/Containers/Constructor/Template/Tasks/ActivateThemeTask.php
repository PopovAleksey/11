<?php

namespace App\Containers\Constructor\Template\Tasks;

use App\Containers\Constructor\Template\Data\Dto\ThemeDto;
use App\Containers\Constructor\Template\Data\Repositories\ThemeRepositoryInterface;
use App\Containers\Constructor\Template\Models\ThemeInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class ActivateThemeTask extends Task implements ActivateThemeTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Template\Data\Dto\ThemeDto $data
     * @return \App\Containers\Constructor\Template\Data\Dto\ThemeDto
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     * @TODO Need implement transaction
     */
    public function run(ThemeDto $data): ThemeDto
    {
        try {
            if ($data->isActive() === true) {
                $this->repository
                    ->findByField('active', true)
                    ->each(fn(ThemeInterface $theme) => $this->repository->update(['active' => false], $theme->id));
            }

            $theme = $this->repository->update($data->toArray(), $data->getId());

            return (new ThemeDto())
                ->setId($theme->id)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
