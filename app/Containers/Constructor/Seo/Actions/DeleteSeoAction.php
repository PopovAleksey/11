<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Tasks\DeleteSeoTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteSeoAction extends Action implements DeleteSeoActionInterface
{
    public function __construct(
        private readonly DeleteSeoTaskInterface $deleteSeoTask
    )
    {
    }

    public function run(int $id): void
    {
        $this->deleteSeoTask->run($id);
    }
}

