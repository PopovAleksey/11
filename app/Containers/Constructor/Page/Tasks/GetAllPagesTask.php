<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllPagesTask extends Task implements GetAllPagesTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    public function run(): Collection
    {
        return $this->repository->all()->collect()
            ->filter(fn(PageInterface $page) => $page->parent_page_id === null)
            ->map(static function (PageInterface $page) {
                $pageDto = (new PageDto())
                    ->setId($page->id)
                    ->setName($page->name)
                    ->setType($page->type)
                    ->setActive($page->active)
                    ->setCreateAt($page->created_at)
                    ->setUpdateAt($page->updated_at);

                if ($page->type === PageInterface::BLOG_TYPE) {
                    $childPage = $page->child_page;

                    $childPageDto = (new PageDto())
                        ->setId($childPage->id)
                        ->setName($childPage->name)
                        ->setType($childPage->type)
                        ->setActive($childPage->active)
                        ->setCreateAt($childPage->created_at)
                        ->setUpdateAt($childPage->updated_at);

                    $pageDto->setChildPage($childPageDto);
                }

                return $pageDto;
            });
    }
}
