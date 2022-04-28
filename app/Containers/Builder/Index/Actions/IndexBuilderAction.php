<?php

namespace App\Containers\Builder\Index\Actions;

use App\Containers\Builder\Index\Tasks\IndexBuilderTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class IndexBuilderAction extends Action implements IndexBuilderActionInterface
{
    public function __construct(
        private IndexBuilderTaskInterface $getAllIndexTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllIndexTask->run();
    }
}
