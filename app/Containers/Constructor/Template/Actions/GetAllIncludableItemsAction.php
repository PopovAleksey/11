<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Tasks\GetAllIncludableItemsTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetAllIncludableItemsAction extends Action implements GetAllIncludableItemsActionInterface
{
    public function __construct(
        private GetAllIncludableItemsTaskInterface $getAllTemplateTask
    )
    {
    }

    public function run(int $themeId): Collection
    {
        return $this->getAllTemplateTask->run($themeId);
    }
}
