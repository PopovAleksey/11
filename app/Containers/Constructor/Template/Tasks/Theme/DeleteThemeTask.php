<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Storage;

class DeleteThemeTask extends Task implements DeleteThemeTaskInterface
{
    public function __construct(private ThemeRepositoryInterface $repository)
    {
    }

    /**
     * @throws \App\Ship\Exceptions\DeleteResourceFailedException
     */
    public function run(int $id): ?bool
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\ThemeInterface $theme
             */
            $theme = $this->repository->find($id);

            $this->repository->delete($theme->id);

            Storage::disk('template')->deleteDir($theme->directory);

            return true;
        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
