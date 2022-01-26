<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Language\Data\Repositories\LanguageRepositoryInterface;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class UpdateLanguageTask extends Task implements UpdateLanguageTaskInterface
{
    public function __construct(private LanguageRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Language\Data\Dto\LanguageDto $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \App\Ship\Exceptions\UpdateResourceFailedException
     */
    public function run(LanguageDto $data): mixed
    {
        try {
            return $this->repository->update([
                'active' => $data->isActive(),
            ], $data->getId());
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
