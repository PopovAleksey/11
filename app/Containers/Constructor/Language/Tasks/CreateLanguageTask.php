<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Containers\Constructor\Language\Data\Dto\LanguageDto;
use App\Containers\Constructor\Language\Data\Repositories\LanguageRepositoryInterface;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateLanguageTask extends Task implements CreateLanguageTaskInterface
{
    public function __construct(private LanguageRepositoryInterface $repository)
    {
    }

    /**
     * @param \App\Containers\Constructor\Language\Data\Dto\LanguageDto $data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \App\Ship\Exceptions\CreateResourceFailedException
     */
    public function run(LanguageDto $data): mixed
    {
        try {
            return $this->repository->create([
                'name'       => $data->getName(),
                'short_name' => $data->getShortName(),
                'active'     => $data->isActive(),
            ]);
        } catch (Exception $exception) {
            throw new CreateResourceFailedException();
        }
    }
}
