<?php

namespace App\Containers\Constructor\Template\Actions;

use App\Containers\Constructor\Template\Tasks\GetListBaseTemplatesTaskInterface;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Collection;

class GetListBaseTemplatesAction extends Action implements GetListBaseTemplatesActionInterface
{
    public function __construct(
        private readonly GetListBaseTemplatesTaskInterface $getAllTemplateTask
    )
    {
    }

    public function run(int $themeId, int $languageId = null): Collection
    {
        return $this->getAllTemplateTask->run($themeId, $languageId);
    }
}
