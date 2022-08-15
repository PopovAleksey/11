<?php

namespace App\Containers\Dashboard\Content\Tasks;

use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Dto\ContentDto;
use App\Ship\Parents\Dto\ContentValueDto;
use App\Ship\Parents\Dto\PageDto;
use App\Ship\Parents\Dto\PageFieldDto;
use App\Ship\Parents\Models\ContentInterface;
use App\Ship\Parents\Models\ContentValueInterface;
use App\Ship\Parents\Models\PageFieldInterface;
use App\Ship\Parents\Models\PageInterface;
use App\Ship\Parents\Repositories\ContentRepositoryInterface;
use App\Ship\Parents\Repositories\ContentValueRepositoryInterface;
use App\Ship\Parents\Repositories\LanguageRepositoryInterface;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Collection;

class GetAllContentsTask extends Task implements GetAllContentsTaskInterface
{
    public function __construct(
        private readonly ContentRepositoryInterface      $contentRepository,
        private readonly ContentValueRepositoryInterface $contentValueRepository,
        private readonly LanguageRepositoryInterface     $languageRepository
    )
    {
    }

    /**
     * @param int      $pageId
     * @param int|null $parentContentId
     * @return \Illuminate\Support\Collection
     * @throws \App\Ship\Exceptions\NotFoundException
     */
    public function run(int $pageId, ?int $parentContentId = null): Collection
    {
        try {
            $pageDto  = null;
            $contents = $this->contentRepository->orderBy('created_at', 'desc');

            if ($parentContentId === null) {
                $contents = $contents->findByField('page_id', $pageId);
            } else {
                $contents = $contents->findWhere([
                    'page_id'           => $pageId,
                    'parent_content_id' => $parentContentId,
                ]);
            }

            /**
             * @var \App\Ship\Parents\Models\LanguageInterface|null $firstLanguage
             */
            $firstLanguage = $this->languageRepository->first();

            if ($firstLanguage === null) {
                throw new NotFoundException('Not found any language! Create one or more languages');
            }

            $contentIds = $contents->map(fn(ContentInterface $content) => $content->id)->toArray();
            $values     = $this->contentValueRepository
                ->findWhereIn('content_id', $contentIds)
                ->filter(fn(ContentValueInterface $value) => $value->language_id === $firstLanguage->id)
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
                    ->setParentContentId($content->parent_content_id)
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
     * @param \App\Ship\Parents\Models\PageInterface $page
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
