<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Tasks\GetAllSeosTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllSeosAction extends Action implements GetAllSeosActionInterface
{
    public function __construct(
        private GetAllSeosTaskInterface $getAllSeoTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllSeoTask->run();
    }
}
