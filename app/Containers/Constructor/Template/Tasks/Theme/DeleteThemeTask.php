<?php

namespace App\Containers\Constructor\Template\Tasks\Theme;

use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Repositories\ThemeRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Storage;

class DeleteThemeTask extends Task implements DeleteThemeTaskInterface
{
    public function __construct(
        private readonly ThemeRepositoryInterface $repository
    )
    {
    }

    /**
     * @throws \App\Ship\Exceptions\DeleteResourceFailedException
     */
    public function run(int $id): void
    {
        try {
            /**
             * @var \App\Ship\Parents\Models\ThemeInterface $theme
             */
            $theme = $this->repository->find($id);

            $this->repository->delete($theme->id);

            Storage::disk('template')->deleteDirectory($theme->directory);

        } catch (Exception) {
            throw new DeleteResourceFailedException();
        }
    }
}
