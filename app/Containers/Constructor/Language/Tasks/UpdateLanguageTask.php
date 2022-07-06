<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Dto\LanguageDto;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateLanguageTask extends Task implements UpdateLanguageTaskInterface
{
    public function __construct(
        private readonly LanguageRepositoryInterface $repository
    )
    {
    }

    /**
     * @param \App\Ship\Parents\Dto\LanguageDto $data
     * @return void
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(LanguageDto $data): void
    {
        try {
            $this->repository->update(['active' => $data->isActive()], $data->getId());

        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
