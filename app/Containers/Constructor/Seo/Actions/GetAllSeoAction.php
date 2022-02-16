<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Tasks\GetAllSeoTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllSeoAction extends Action implements GetAllSeoActionInterface
{
    public function __construct(
        private GetAllSeoTaskInterface $getAllSeoTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllSeoTask->run();
    }
}
