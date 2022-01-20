<?php

namespace App\Containers\Constructor\Language\Tasks;

use App\Containers\Constructor\Language\Data\Repositories\LanguageRepository;
use App\Ship\Parents\Tasks\Task;

class GetAllLanguagesTask extends Task
{
    protected LanguageRepository $repository;

    public function __construct(LanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->paginate();
    }
}
