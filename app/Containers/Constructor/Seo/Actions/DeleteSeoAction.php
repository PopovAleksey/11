<?php

namespace App\Containers\Constructor\Seo\Actions;

use App\Containers\Constructor\Seo\Tasks\DeleteSeoTaskInterface;
use App\Ship\Parents\Actions\Action;

class DeleteSeoAction extends Action implements DeleteSeoActionInterface
{
    public function __construct(
        private DeleteSeoTaskInterface $deleteSeoTask
    )
    {
    }

    public function run(int $id): bool
    {
        return $this->deleteSeoTask->run($id);
    }
}

interface DeleteSeoActionInterface
{
    public function run(int $id): bool;
}