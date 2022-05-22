<?php

namespace App\Containers\Constructor\Page\Actions;

use App\Containers\Constructor\Page\Tasks\Page\GetAllPagesTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllPagesAction extends Action implements GetAllPagesActionInterface
{
    public function __construct(
        private GetAllPagesTaskInterface $getAllPageTask
    )
    {
    }

    public function run(bool $withFields = false): Collection
    {
        return $this->getAllPageTask->run($withFields);
    }
}
