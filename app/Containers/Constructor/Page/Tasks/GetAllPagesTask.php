<?php

namespace App\Containers\Constructor\Page\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Containers\Constructor\Page\Data\Repositories\PageRepositoryInterface;
use App\Containers\Constructor\Page\Models\PageFieldInterface;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Support\Collection;

class GetAllPagesTask extends Task implements GetAllPagesTaskInterface
{
    public function __construct(private PageRepositoryInterface $repository)
    {
    }

    public function run(bool $withFields = false): Collection
    {
        return $this->repository->all()->collect()
            ->filter(fn(PageInterface $page) => $page->parent_page_id === null)
            ->map(function (PageInterface $page) use ($withFields) {
                $pageDto = $this->buildPageDto($page, $withFields);

                if ($page->type === PageInterface::BLOG_TYPE) {
                    $childPageDto = $this->buildPageDto($page->child_page, $withFields);
                    $pageDto->setChildPage($childPageDto);
                }

                return $pageDto;
            });
    }

    private function buildPageDto(PageInterface $page, bool $withFields): PageDto
    {
        $pageDto = (new PageDto())
            ->setId($page->id)
            ->setName($page->name)
            ->setType($page->type)
            ->setActive($page->active)
            ->setCreateAt($page->created_at)
            ->setUpdateAt($page->updated_at);

        if ($withFields === true) {
            $fields = $this->buildPageFieldsDto($page->fields);
            $pageDto->setFields($fields);
        }

        return $pageDto;
    }

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
