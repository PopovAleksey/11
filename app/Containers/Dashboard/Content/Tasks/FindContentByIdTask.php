<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Constructor\Page\Data\Dto\PageDto;
use App\Containers\Constructor\Page\Data\Dto\PageFieldDto;
use App\Containers\Constructor\Page\Models\PageFieldInterface;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Containers\Dashboard\Content\Data\Dto\ContentDto;
use App\Containers\Dashboard\Content\Data\Dto\ContentValueDto;
use App\Containers\Dashboard\Content\Data\Repositories\ContentRepositoryInterface;
use App\Containers\Dashboard\Content\Models\ContentInterface;
use App\Containers\Dashboard\Content\Models\ContentValueInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class FindContentByIdTask extends Task implements FindContentByIdTaskInterface
{
    public function __construct(private ContentRepositoryInterface $repository)
    {
    }

    /**
     * @param int $pageId
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $pageId): Collection
    {
        try {
            $contents = $this->repository->findByField('page_id', $pageId);
            $pageDto  = null;

            return collect($contents)->map(function (ContentInterface $content) use (&$pageDto) {
                $pageDto = $pageDto ?? $this->buildPageDto($content->page);
                $values  = $content->values->map(static function (ContentValueInterface $value) {
                    return (new ContentValueDto())
                        ->setId($value->id)
                        ->setLanguageId($value->language_id)
                        ->setPageFieldId($value->page_field_id)
                        ->setValue($value->value)
                        ->setContentId($value->content_id)
                        ->setCreateAt($value->created_at)
                        ->setUpdateAt($value->updated_at);
                });

                return (new ContentDto())
                    ->setId($content->id)
                    ->setPageId($content->page_id)
                    ->setActive($content->active)
                    ->setPage($pageDto)
                    ->setValues($values->toArray())
                    ->setCreateAt($content->created_at)
                    ->setUpdateAt($content->updated_at);
            });


        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \App\Containers\Constructor\Page\Models\PageInterface $page
     * @return \App\Containers\Constructor\Page\Data\Dto\PageDto
     */
    private function buildPageDto(PageInterface $page): PageDto
    {
        $fields = $page->fields->map(static function (PageFieldInterface $field) {
            return (new PageFieldDto())
                ->setId($field->id)
                ->setType($field->type)
                ->setActive($field->active)
                ->setName($field->name)
                ->setPageId($field->page_id)
                ->setPlaceholder($field->placeholder)
                ->setMask($field->mask)
                ->setValues($field->values)
                ->setCreateAt($field->created_at)
                ->setUpdateAt($field->updated_at);
        });

        return (new PageDto())
            ->setId($page->id)
            ->setName($page->name)
            ->setActive($page->active)
            ->setType($page->type)
            ->setFields($fields->toArray())
            ->setCreateAt($page->created_at)
            ->setUpdateAt($page->updated_at);
    }
}
