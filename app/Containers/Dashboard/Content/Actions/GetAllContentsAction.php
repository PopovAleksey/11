<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Dashboard\Content\Tasks\GetAllContentsTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllContentsAction extends Action implements GetAllContentsActionInterface
{
    public function __construct(
        private GetAllContentsTaskInterface $getAllContentTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllContentTask->run();
    }
}
