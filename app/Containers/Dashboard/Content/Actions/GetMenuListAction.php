<?php

namespace App\Containers\Dashboard\Content\Actions;

use App\Containers\Constructor\Page\Tasks\Page\GetAllPagesTaskInterface;
use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Dto\PageDto;
use Illuminate\Support\Collection;

class GetMenuListAction extends Action implements GetMenuListActionInterface
{
    public function __construct(
        private readonly GetAllPagesTaskInterface $getAllPagesTask
    )
    {
    }

    public function run(): Collection
    {
        return $this->getAllPagesTask->run()->reject(fn(PageDto $page) => $page->isActive() === false);
    }
}
