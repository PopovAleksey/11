<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Containers\Constructor\Page\Models\PageFieldInterface;
use App\Containers\Constructor\Page\Models\PageInterface;
use App\Containers\Dashboard\Content\Models\ContentInterface;
use App\Containers\Dashboard\Content\Models\ContentValueInterface;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\PageFieldDto;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class GetAllContentsTask extends Task implements GetAllContentsTaskInterface
{
    public function __construct(
        private ContentRepositoryInterface      $contentRepository,
        private ContentValueRepositoryInterface $contentValueRepository
    )
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
            $pageDto    = null;
            $contents   = $this->contentRepository->orderBy('created_at', 'desc')->findByField('page_id', $pageId);
            $contentIds = $contents->map(fn(ContentInterface $content) => $content->id)->toArray();
            $values     = $this->contentValueRepository
                ->findWhereIn('content_id', $contentIds)
                ->filter(fn(ContentValueInterface $value) => $value->language_id === 1)
                ->map(static function (ContentValueInterface $value) {
                    return (new ContentValueDto())
                        ->setId($value->id)
                        ->setLanguageId($value->language_id)
                        ->setPageFieldId($value->page_field_id)
                        ->setValue($value->value)
                        ->setContentId($value->content_id)
                        ->setCreateAt($value->created_at)
                        ->setUpdateAt($value->updated_at);
                })
                ->groupBy(fn(ContentValueDto $value) => $value->getContentId());

            return collect($contents)->map(function (ContentInterface $content) use (&$pageDto, $values) {
                $pageDto = $pageDto ?? $this->buildPageDto($content->page);

                return (new ContentDto())
                    ->setId($content->id)
                    ->setPageId($content->page_id)
                    ->setActive($content->active)
                    ->setPage($pageDto)
                    ->setValues($values->get($content->id)->toArray())
                    ->setCreateAt($content->created_at)
                    ->setUpdateAt($content->updated_at);
            });

        } catch (Exception) {
            throw new NotFoundException();
        }
    }

    /**
     * @param \App\Containers\Constructor\Page\Models\PageInterface $page
     * @return \App\Ship\Parents\Dto\PageDto
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

        $pageDto = (new PageDto())
            ->setId($page->id)
            ->setName($page->name)
            ->setActive($page->active)
            ->setType($page->type)
            ->setFields($fields->toArray())
            ->setCreateAt($page->created_at)
            ->setUpdateAt($page->updated_at);

        if ($page->type === PageInterface::BLOG_TYPE) {
            $childPage = $this->buildPageDto($page->child_page);
            $pageDto->setChildPage($childPage);
        }

        return $pageDto;
    }
}
