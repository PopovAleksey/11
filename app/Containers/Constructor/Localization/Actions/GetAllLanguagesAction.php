<?php

namespace App\Containers\Constructor\Localization\Actions;

use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllLanguagesAction extends Action implements GetAllLanguagesActionInterface
{
    public function __construct(private readonly GetAllLanguagesTaskInterface $allLanguagesTask)
    {
    }

    public function run(bool $getOnlyActive = false): Collection
    {
        return $this->allLanguagesTask->run();
    }
}
