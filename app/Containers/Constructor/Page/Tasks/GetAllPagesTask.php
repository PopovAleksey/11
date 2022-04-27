<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\PageFieldDto;
use App\Ship\Parents\Models\PageFieldInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Repositories\PageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllPagesTask extends Task implements GetAllPagesTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    /**
     * @param bool $withFields
     * @return \Illuminate\Support\Collection
     */
    public function run(bool $withFields = false): Collection
    {
        $pageList = $this->repository->all()->collect()
            ->mapWithKeys(fn(PageInterface $page) => [$page->id => $this->buildPageDto($page, $withFields)]);

        return $pageList
            ->filter(fn(PageDto $page) => $page->getParentPageId() === null)
            ->map(function (PageDto $page) use ($pageList) {
                if ($page->getType() !== PageInterface::BLOG_TYPE) {
                    return $page;
                }

                $childPageDto = $pageList->filter(fn(PageDto $childPage) => $childPage->getParentPageId() === $page->getId())->first();

                return $page->setChildPage($childPageDto);
            });
    }

    /**
     * @param \App\Ship\Parents\Models\PageInterface $page
     * @param bool                                   $withFields
     * @return \App\Ship\Parents\Dto\PageDto
     */
    private function buildPageDto(PageInterface $page, bool $withFields): PageDto
    {
        $pageDto = (new PageDto())
            ->setId($page->id)
            ->setName($page->name)
            ->setType($page->type)
            ->setActive($page->active)
            ->setParentPageId($page->parent_page_id)
            ->setCreateAt($page->created_at)
            ->setUpdateAt($page->updated_at);

        if ($withFields === true) {
            $fields = $this->buildPageFieldsDto($page->fields);
            $pageDto->setFields($fields);
        }

        return $pageDto;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection $fields
     * @return array
     */
    private function buildPageFieldsDto(\Illuminate\Database\Eloquent\Collection $fields): array
    {
        return $fields
            ->map(static function (PageFieldInterface $field) {
                return (new PageFieldDto())
                    ->setId($field->id)
                    ->setPageId($field->page_id)
                    ->setType($field->type)
                    ->setName($field->name)
                    ->setPlaceholder($field->placeholder)
                    ->setMask($field->mask)
                    ->setValues($field->values)
                    ->setActive($field->active)
                    ->setCreateAt($field->created_at)
                    ->setUpdateAt($field->updated_at);
            })->toArray();
    }
}
