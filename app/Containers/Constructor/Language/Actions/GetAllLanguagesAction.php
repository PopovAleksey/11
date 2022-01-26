<?php

namespace App\Containers\Constructor\Language\Actions;

use App\Containers\Constructor\Language\Tasks\GetAllLanguagesTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllLanguagesAction extends Action implements GetAllLanguagesActionInterface
{
    public function __construct(private GetAllLanguagesTaskInterface $allLanguagesTask)
    {
    }

    public function run(): Collection
    {
        return $this->allLanguagesTask->run();
    }
}
