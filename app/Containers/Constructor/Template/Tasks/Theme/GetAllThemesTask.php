<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Parents\Dto\ThemeDto;
use App\Ship\Parents\Models\ThemeInterface;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllThemesTask extends Task implements GetAllThemesTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    public function run(): Collection
    {
        return $this->repository->all()->collect()->map(static function (ThemeInterface $theme) {
            return (new ThemeDto())
                ->setId($theme->id)
                ->setName($theme->name)
                ->setDirectory($theme->directory)
                ->setActive($theme->active)
                ->setCreateAt($theme->created_at)
                ->setUpdateAt($theme->updated_at);
        });
    }
}
